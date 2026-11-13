const path = require('path');
require('dotenv').config({ path: path.join(__dirname, '..', '.env') });
const crypto = require('crypto');
const http = require('http');
const express = require('express');
const { Server } = require('socket.io');

const PORT = process.env.CHAT_SOCKET_PORT || 6002;
const SECRET = process.env.CHAT_SOCKET_SECRET;
const ORIGINS = (process.env.CHAT_SOCKET_ORIGINS || '').split(',');
const EVENTS = ['MessageSent', 'MessageChanged', 'MessagesRead', 'UserTyping', 'UserOffline', 'CallOffer','CallingChanged','CallLogged'];
if (!SECRET) { console.error('CHAT_SOCKET_SECRET missing'); process.exit(1); }

const same = (a, b) => { const x = Buffer.from(String(a)), y = Buffer.from(String(b)); return x.length === y.length && crypto.timingSafeEqual(x, y); };

function verify(token) {
  if (typeof token !== 'string') return null;
  const [p, s] = token.split('.');
  if (!p || !s || !same(s, crypto.createHmac('sha256', SECRET).update(p).digest('hex'))) return null;
  try {
    const d = JSON.parse(Buffer.from(p, 'base64url').toString());
    return d.uid && d.exp > Date.now() / 1000 ? Number(d.uid) : null;
  } catch { return null; }
}

const app = express();
app.use(express.json({ limit: '1mb' }));
const server = http.createServer(app);
const io = new Server(server, { cors: { origin: ORIGINS } });
const online = new Map();
const calls = new Map(); // call_id -> { a: caller, b: callee }

app.post('/emit', (req, res) => {
  if (!same(req.get('x-chat-secret') || '', SECRET)) return res.status(401).end();
  const { users, event, data } = req.body || {};
  if (!EVENTS.includes(event)) return res.status(422).end();

  if (event === 'CallOffer' && data && data.call_id) {
    const id = String(data.call_id);
    calls.set(id, { a: Number(data.caller_id), b: Number(data.callee_id) });
    setTimeout(() => calls.delete(id), 4 * 60 * 60 * 1000).unref();
  }
  if (users === null) io.emit(event, data);
  else if (Array.isArray(users)) users.forEach((u) => io.to('user:' + Number(u)).emit(event, data));
  res.json({ ok: true });
});

app.get('/health', (req, res) => res.json({ ok: true, online: online.size }));

io.use((socket, next) => {
  const uid = verify(socket.handshake.auth && socket.handshake.auth.token);
  if (!uid) return next(new Error('unauthorized'));
  socket.data.uid = uid;
  next();
});

io.on('connection', (socket) => {
  const uid = socket.data.uid;
  socket.join('user:' + uid);
  const peerOf = (callId) => {
    const c = calls.get(String(callId));
    if (!c || (c.a !== uid && c.b !== uid)) return null;
    return { c, peer: c.a === uid ? c.b : c.a };
  };

  socket.on('call:answer', (d) => {
    const r = d && peerOf(d.call_id);
    if (!r || r.c.b !== uid) return;
    io.to('user:' + r.peer).emit('call:answer', { call_id: d.call_id, sdp: d.sdp });
    socket.to('user:' + uid).emit('call:handled', { call_id: d.call_id });
  });

  socket.on('call:ice', (d) => {
    const r = d && peerOf(d.call_id);
    if (r && d.candidate) io.to('user:' + r.peer).emit('call:ice', { call_id: d.call_id, candidate: d.candidate });
  });

  socket.on('call:end', (d) => {
    const r = d && peerOf(d.call_id);
    if (!r) return;
    calls.delete(String(d.call_id));
    io.to('user:' + r.peer).emit('call:end', { call_id: d.call_id, reason: String(d.reason || 'ended').slice(0, 20) });
    socket.to('user:' + uid).emit('call:handled', { call_id: d.call_id });
  });

  const n = (online.get(uid) || 0) + 1;
  online.set(uid, n);
  socket.emit('presence:here', [...online.keys()]);
  if (n === 1) socket.broadcast.emit('presence:joining', { id: uid });

  socket.on('disconnect', () => {
    const left = (online.get(uid) || 1) - 1;
    if (left <= 0) {
      online.delete(uid); io.emit('presence:leaving', { id: uid });
      for (const [id, c] of calls) {
        if (c.a === uid || c.b === uid) {
          calls.delete(id);
          io.to('user:' + (c.a === uid ? c.b : c.a)).emit('call:end', { call_id: id, reason: 'error' });
        }
      }
    }
    else online.set(uid, left);
  });
});

server.listen(PORT, '127.0.0.1', () => console.log('Chat socket on ' + PORT));