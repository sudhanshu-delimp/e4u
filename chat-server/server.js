const path = require('path');
require('dotenv').config({ path: path.join(__dirname, '..', '.env') });
const crypto = require('crypto');
const http = require('http');
const express = require('express');
const { Server } = require('socket.io');

const PORT = process.env.CHAT_SOCKET_PORT || 6002;
const SECRET = process.env.CHAT_SOCKET_SECRET;
const ORIGINS = (process.env.CHAT_SOCKET_ORIGINS || '').split(',');
const EVENTS = ['MessageSent', 'MessageChanged', 'MessagesRead', 'UserTyping', 'UserOffline'];
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

app.post('/emit', (req, res) => {
  if (!same(req.get('x-chat-secret') || '', SECRET)) return res.status(401).end();
  const { users, event, data } = req.body || {};
  if (!EVENTS.includes(event)) return res.status(422).end();
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
  const n = (online.get(uid) || 0) + 1;
  online.set(uid, n);
  socket.emit('presence:here', [...online.keys()]);
  if (n === 1) socket.broadcast.emit('presence:joining', { id: uid });

  socket.on('disconnect', () => {
    const left = (online.get(uid) || 1) - 1;
    if (left <= 0) { online.delete(uid); io.emit('presence:leaving', { id: uid }); }
    else online.set(uid, left);
  });
});

server.listen(PORT, () => console.log('Chat socket on ' + PORT));