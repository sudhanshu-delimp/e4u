// WebRTC audio and video calls. Signaling goes through the chat Node server.
// Loaded by notify.js, so calls ring on every page that has the notifier.

const RING_MS = 45000;
const svg = (inner) =>
    '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' + inner + '</svg>';

const ICON = {
    phone: svg('<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>'),
    hangup: svg('<path d="M10.68 13.31a16 16 0 0 0 3.41 2.6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7 2 2 0 0 1 1.72 2v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.42 19.42 0 0 1-3.33-2.67m-2.67-3.34a19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91"/><line x1="23" y1="1" x2="1" y2="23"/>'),
    mic: svg('<path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>'),
    micOff: svg('<line x1="1" y1="1" x2="23" y2="23"/><path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"/><path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>'),
    video: svg('<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>'),
    videoOff: svg('<path d="M16 16v1a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2m5.66 0H14a2 2 0 0 1 2 2v3.34l1 1L23 7v10"/><line x1="1" y1="1" x2="23" y2="23"/>'),
};

const END_TEXT = {
    declined: 'Call declined',
    busy: 'User is busy',
    cancelled: 'Call cancelled',
    no_answer: 'No answer',
    missed: 'Missed call',
    ended: 'Call ended',
    error: 'Call failed',
};

const CSS =
    '#callOverlay{position:fixed;inset:0;z-index:100000;background:rgba(17,24,39,.88);display:flex;align-items:center;justify-content:center}' +
    '#callOverlay .call-box{position:relative;width:min(900px,96vw);height:min(600px,92vh);background:#111827;border-radius:16px;overflow:hidden;color:#fff}' +
    '#callOverlay .call-remote{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;background:#111827}' +
    '#callOverlay .call-local{position:absolute;right:14px;top:14px;width:140px;height:100px;object-fit:cover;border-radius:10px;border:2px solid rgba(255,255,255,.25);background:#000;transform:scaleX(-1)}' +
    '#callOverlay .call-center{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;pointer-events:none}' +
    '#callOverlay .has-video .call-center{display:none}' +
    '#callOverlay .call-av{width:96px;height:96px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:30px;font-weight:600;overflow:hidden;color:#fff}' +
    '#callOverlay .call-av img{width:100%;height:100%;object-fit:cover}' +
    '#callOverlay .call-name{font-size:20px;font-weight:600}' +
    '#callOverlay .call-status{font-size:14px;opacity:.85}' +
    '#callOverlay .has-video .call-status{position:absolute;left:16px;top:16px;background:rgba(0,0,0,.45);padding:4px 10px;border-radius:12px}' +
    '#callOverlay .call-controls{position:absolute;bottom:22px;left:0;right:0;display:flex;justify-content:center;gap:16px}' +
    '#callOverlay .call-btn{width:54px;height:54px;border-radius:50%;border:0;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff;background:#374151}' +
    '#callOverlay .call-btn.off{background:#fff;color:#111827}' +
    '#callOverlay .call-btn.end{background:#e11d48}' +
    '#callOverlay .call-btn.ok{background:#16a34a}';

export function initCalls({ socket, me, cfg }) {
    if (window.__chatCallsReady) {
        return;
    }

    window.__chatCallsReady = true;
    let iceServers = [];

    try {
        const iceServers = JSON.parse(cfg.ice || 'null') || [{ urls: ['stun:stun.l.google.com:19302'] }];
    } catch (error) {
        console.error('Invalid ICE server configuration:', cfg.ice, error);
    }

    // The single call this tab is part of (null when idle)
    let call = null;


    let audioCtx = null;
    let ringTimer = null;
    

    // kind 'out' = tone the caller hears, 'in' = ringtone for the person being called
    function ring(kind) {
        stopRing();

        try {
            const Ctx = window.AudioContext || window.webkitAudioContext;

            if (!Ctx) {
                return;
            }

            audioCtx = audioCtx || new Ctx();

            if (audioCtx.state === 'suspended') {
                audioCtx.resume().catch(() => { });
            }

            // One soft note: quick fade in, long fade out
            const note = (hz, start, length, volume) => {
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                const t = audioCtx.currentTime + start;

                osc.type = 'sine';
                osc.frequency.value = hz;
                gain.gain.setValueAtTime(0.0001, t);
                gain.gain.exponentialRampToValueAtTime(volume, t + 0.02);
                gain.gain.exponentialRampToValueAtTime(0.0001, t + length);
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.start(t);
                osc.stop(t + length + 0.05);
            };

            const melody = () => {
                // Stop by itself if the call is no longer ringing
                if (!call || (call.state !== 'calling' && call.state !== 'ringing')) {
                    stopRing();

                    return;
                }

                if (kind === 'in') {
                    // Receiver: rising chime C5 E5 G5 C6, then a short pause
                    [523.25, 659.25, 783.99, 1046.5].forEach((hz, i) => note(hz, i * 0.18, 0.9, 0.18));
                } else {
                    // Caller: the original double beep
                    const gain = audioCtx.createGain();

                    gain.gain.value = 0.15;
                    gain.connect(audioCtx.destination);

                    [440, 480].forEach((hz) => {
                        const osc = audioCtx.createOscillator();

                        osc.frequency.value = hz;
                        osc.connect(gain);
                        osc.start();
                        osc.stop(audioCtx.currentTime + 1);
                    });
                }
            };

            melody();
            ringTimer = setInterval(melody, kind === 'in' ? 2500 : 3000);
        } catch (error) {
            // Sound is optional, never break the call because of it
        }
    }

    function stopRing() {
        clearInterval(ringTimer);
        ringTimer = null;
    }

    /* ---------------------------------------------------
       Small helpers
    --------------------------------------------------- */

    const q = (selector) => document.querySelector('#callOverlay ' + selector);

    const avatarUrl = (path) => {
        if (!path) {
            return '';
        }

        return /^(https?:)?\//.test(path) ? path : (cfg.avatarBase || '') + '/' + path;
    };

    const initials = (name) => (name || '?').split(' ').map((w) => w[0]).join('').slice(0, 2).toUpperCase();

    const clock = (ms) => {
        const total = Math.floor(ms / 1000);
        const mm = String(Math.floor(total / 60)).padStart(2, '0');
        const ss = String(total % 60).padStart(2, '0');

        return mm + ':' + ss;
    };

    function say(message) {
        if (typeof showAlert === 'function') {
            showAlert('error', message);
        } else {
            window.alert(message);
        }
    }

    function mediaError(error) {
        if (error && error.name === 'NotAllowedError') {
            return 'Allow camera and microphone access in your browser to make calls.';
        }

        if (error && error.name === 'NotFoundError') {
            return 'No camera or microphone was found.';
        }

        return 'Could not access the camera or microphone.';
    }

    function setStatus(text) {
        const node = q('.call-status');

        if (node) {
            node.textContent = text;
        }
    }

    /* ---------------------------------------------------
       Screen
    --------------------------------------------------- */

    function showUi() {
        if (!document.getElementById('callCss')) {
            const style = document.createElement('style');

            style.id = 'callCss';
            style.textContent = CSS;
            document.head.appendChild(style);
        }

        const old = document.getElementById('callOverlay');

        if (old) {
            old.remove();
        }

        const overlay = document.createElement('div');

        overlay.id = 'callOverlay';
        overlay.innerHTML =
            '<div class="call-box">' +
            '<video class="call-remote" autoplay playsinline></video>' +
            '<video class="call-local" autoplay playsinline muted></video>' +
            '<div class="call-center"><div class="call-av"></div><div class="call-name"></div><div class="call-status"></div></div>' +
            '<div class="call-controls"></div>' +
            '</div>';
        document.body.appendChild(overlay);

        const peer = call.peer || {};
        const av = overlay.querySelector('.call-av');

        av.style.background = peer.color || '#ff3c5f';
        av.textContent = initials(peer.name);

        if (peer.avatar) {
            const img = new Image();

            img.alt = '';
            img.onload = () => { av.textContent = ''; av.appendChild(img); };
            img.src = avatarUrl(peer.avatar);
        }

        overlay.querySelector('.call-name').textContent = peer.name || 'Unknown';

        if (call.kind !== 'video') {
            overlay.querySelector('.call-local').style.display = 'none';
        }
    }

    function controls(mode) {
        const box = q('.call-controls');

        if (!box || !call) {
            return;
        }

        box.innerHTML = '';

        const add = (cls, icon, label, handler) => {
            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'call-btn ' + cls;
            button.title = label;
            button.setAttribute('aria-label', label);
            button.innerHTML = icon;
            button.addEventListener('click', handler);
            box.appendChild(button);
        };

        if (mode === 'ringing') {
            add('end', ICON.hangup, 'Decline', () => endCall('declined', true));
            add('ok', call.kind === 'video' ? ICON.video : ICON.phone, 'Accept', accept);

            return;
        }

        if (mode === 'active') {
            add(call.muted ? 'off' : '', call.muted ? ICON.micOff : ICON.mic, 'Mute', () => {
                call.muted = !call.muted;
                call.local.getAudioTracks().forEach((t) => { t.enabled = !call.muted; });
                controls('active');
            });

            if (call.kind === 'video') {
                add(call.camOff ? 'off' : '', call.camOff ? ICON.videoOff : ICON.video, 'Camera', () => {
                    call.camOff = !call.camOff;
                    call.local.getVideoTracks().forEach((t) => { t.enabled = !call.camOff; });
                    controls('active');
                });
            }
        }

        add('end', ICON.hangup, mode === 'active' ? 'End call' : 'Cancel', () => endCall(call && call.state === 'calling' ? 'cancelled' : 'ended', true));
    }

    /* ---------------------------------------------------
       Peer connection
    --------------------------------------------------- */

    function sendIce(candidate) {
        if (call.id) {
            socket.emit('call:ice', { call_id: call.id, candidate });
        } else {
            call.iceOut.push(candidate);
        }
    }

    function flushIceIn() {
        call.iceIn.splice(0).forEach((c) => call.pc.addIceCandidate(c).catch(() => { }));
    }

    function makePc() {
        const pc = new RTCPeerConnection({ iceServers });

        call.pc = pc;

        pc.ontrack = (event) => {
            const video = q('.call-remote');

            if (video && event.streams && event.streams[0]) {
                video.srcObject = event.streams[0];
                const played = video.play();

                if (played && played.catch) {
                    played.catch(() => { });
                }
            }
        };

        pc.onicecandidate = (event) => {
            if (call && call.pc === pc && event.candidate) {
                sendIce(event.candidate.toJSON ? event.candidate.toJSON() : event.candidate);
            }
        };

        pc.onconnectionstatechange = () => {
            if (!call || call.pc !== pc) {
                return;
            }

            const state = pc.connectionState;

            if (state === 'connected') {
                clearTimeout(call.dropTimer);
                onConnected();
            } else if (state === 'disconnected') {
                setStatus('Reconnecting...');
                call.dropTimer = setTimeout(() => {
                    if (call && call.pc === pc && pc.connectionState !== 'connected') {
                        endCall('error', true);
                    }
                }, 10000);
            } else if (state === 'failed') {
                endCall('error', true);
            }
        };

        call.local.getTracks().forEach((track) => pc.addTrack(track, call.local));

        return pc;
    }

    function attachLocal() {
        const video = q('.call-local');

        if (video && call.kind === 'video') {
            video.srcObject = call.local;
        }
    }

    function onConnected() {
        if (!call || call.state === 'active') {
            return;
        }

        call.state = 'active';
        call.startedAt = Date.now();
        clearTimeout(call.ringTimer);

        const box = q('.call-box');

        if (box && call.kind === 'video') {
            box.classList.add('has-video');
        }

        controls('active');
        setStatus('00:00');
        call.tick = setInterval(() => setStatus(clock(Date.now() - call.startedAt)), 1000);
    }

    /* ---------------------------------------------------
       Finish
    --------------------------------------------------- */

    function finish(text) {
        stopRing();
        const done = call;

        if (!done) {
            return;
        }

        call = null;

        clearTimeout(done.ringTimer);
        clearTimeout(done.dropTimer);
        clearInterval(done.tick);

        if (done.pc) {
            done.pc.ontrack = null;
            done.pc.onicecandidate = null;
            done.pc.onconnectionstatechange = null;
            done.pc.close();
        }

        if (done.local) {
            done.local.getTracks().forEach((t) => t.stop());
        }

        const overlay = document.getElementById('callOverlay');

        if (overlay) {
            const status = overlay.querySelector('.call-status');
            const box = overlay.querySelector('.call-controls');

            if (status) {
                status.textContent = text || '';
            }

            if (box) {
                box.innerHTML = '';
            }

            overlay.querySelector('.call-box').classList.remove('has-video');
            setTimeout(() => overlay.remove(), 1500);
        }
    }

    function endCall(reason, tell) {
        if (!call) {
            return;
        }

        if (tell && call.id) {
            socket.emit('call:end', { call_id: call.id, reason });
        }

        finish(END_TEXT[reason] || 'Call ended');
    }

    function fail(message) {
        endCall('error', true);
        say(message);
    }

    /* ---------------------------------------------------
       Caller
    --------------------------------------------------- */

    async function start(detail) {
        if (call) {
            // A second click or listener within 2 seconds is a duplicate, ignore it
            if (Date.now() - call.createdAt > 2000) {
                say('You are already in a call.');
            }

            return;
        }

        if (!window.RTCPeerConnection || !navigator.mediaDevices) {
            say('Calls need a secure (https) page and an up to date browser.');

            return;
        }

        const mine = newCall({
            conversationId: detail.conversation_id,
            kind: detail.kind === 'video' ? 'video' : 'audio',
            role: 'caller',
            peer: detail.peer || {},
            state: 'calling',
            createdAt: Date.now(),
        });

        call = mine;
        showUi();
        setStatus('Starting...');
        controls('calling');

        try {
            mine.local = await navigator.mediaDevices.getUserMedia({ audio: true, video: mine.kind === 'video' });
        } catch (error) {
            if (call === mine) {
                fail(mediaError(error));
            }

            return;
        }

        if (call !== mine) {
            mine.local.getTracks().forEach((t) => t.stop());

            return;
        }

        try {
            attachLocal();
            makePc();

            const offer = await mine.pc.createOffer();

            await mine.pc.setLocalDescription(offer);

            const response = await fetch(cfg.callUrl.replace('__ID__', mine.conversationId), {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': cfg.csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ kind: mine.kind, sdp: offer.sdp }),
            });

            if (!response.ok) {
                throw new Error(response.status === 403 ? 'You cannot call this user.' : 'The call could not be started.');
            }

            const data = await response.json();

            // The caller hung up while the request was in flight
            if (call !== mine) {
                socket.emit('call:end', { call_id: data.call_id, reason: 'cancelled' });

                return;
            }

            mine.id = data.call_id;
            mine.iceOut.splice(0).forEach(sendIce);
            setStatus('Calling...');
            ring('out');
            mine.ringTimer = setTimeout(() => endCall('no_answer', true), RING_MS);
        } catch (error) {
            if (call === mine) {
                fail(error.message || 'The call could not be started.');
            }
        }
    }

    function newCall(props) {
        return Object.assign({
            id: null,
            pc: null,
            local: null,
            offerSdp: null,
            iceOut: [],
            iceIn: [],
            muted: false,
            camOff: false,
            startedAt: 0,
            ringTimer: null,
            dropTimer: null,
            tick: null,
        }, props);
    }

    /* ---------------------------------------------------
       Callee
    --------------------------------------------------- */

    async function accept() {
        const mine = call;

        if (!mine || mine.state !== 'ringing') {
            return;
        }

        clearTimeout(mine.ringTimer);
        mine.state = 'connecting';
        setStatus('Connecting...');
        controls('connecting');

        try {
            mine.local = await navigator.mediaDevices.getUserMedia({ audio: true, video: mine.kind === 'video' });
        } catch (error) {
            if (call === mine) {
                say(mediaError(error));
                endCall('declined', true);
            }

            return;
        }

        if (call !== mine) {
            mine.local.getTracks().forEach((t) => t.stop());

            return;
        }

        try {
            attachLocal();
            makePc();
            const sdp = mine.offerSdp.split(/\r?\n/).filter(Boolean).join('\r\n') + '\r\n';

            await mine.pc.setRemoteDescription({ type: 'offer', sdp });
            flushIceIn();

            const answer = await mine.pc.createAnswer();

            await mine.pc.setLocalDescription(answer);
            socket.emit('call:answer', { call_id: mine.id, sdp: answer.sdp });
        } catch (error) {
            console.error('Call accept failed:', error);
            if (call === mine) {
                fail('The call could not be connected.');
            }

        }
    }

    socket.on('CallOffer', (data) => {
        if (!data || !data.call_id || !data.from || data.from.id === me) {
            return;
        }

        if (call) {
            socket.emit('call:end', { call_id: data.call_id, reason: 'busy' });

            return;
        }

        call = newCall({
            id: data.call_id,
            conversationId: data.conversation_id,
            kind: data.kind === 'video' ? 'video' : 'audio',
            role: 'callee',
            peer: data.from,
            state: 'ringing',
            offerSdp: data.sdp,
        });

        showUi();
        setStatus(call.kind === 'video' ? 'Incoming video call...' : 'Incoming audio call...');
        controls('ringing');
        ring('in');
        call.ringTimer = setTimeout(() => finish(END_TEXT.missed), RING_MS + 3000);

        if (document.hidden && 'Notification' in window && Notification.permission === 'granted') {
            const note = new Notification((data.from.name || 'Someone') + ' is calling you', { tag: 'chat-call' });

            note.onclick = () => { window.focus(); note.close(); };
        }
    });

    /* ---------------------------------------------------
       Signals from the other person
    --------------------------------------------------- */

    socket.on('call:answer', async (data) => {
        if (!call || call.role !== 'caller' || !data || data.call_id !== call.id || !call.pc) {
            return;
        }

        clearTimeout(call.ringTimer);
        call.state = 'connecting';
        setStatus('Connecting...');

        try {
            await call.pc.setRemoteDescription({ type: 'answer', sdp: data.sdp });
            flushIceIn();
        } catch (error) {
            fail('The call could not be connected.');
        }
    });

    socket.on('call:ice', (data) => {
        if (!call || !data || data.call_id !== call.id || !data.candidate) {
            return;
        }

        if (call.pc && call.pc.remoteDescription) {
            call.pc.addIceCandidate(data.candidate).catch(() => { });
        } else {
            call.iceIn.push(data.candidate);
        }
    });

    socket.on('call:end', (data) => {
        if (!call || !data || data.call_id !== call.id) {
            return;
        }

        let text = END_TEXT[data.reason] || END_TEXT.ended;

        if (call.role === 'callee' && call.state === 'ringing' && (data.reason === 'cancelled' || data.reason === 'no_answer')) {
            text = END_TEXT.missed;
        }

        finish(text);
    });

    // Another tab of mine answered or declined this call
    socket.on('call:handled', (data) => {
        if (call && call.role === 'callee' && call.state === 'ringing' && data && data.call_id === call.id) {
            finish('');
        }
    });

    // Chat header buttons (controller.js) ask for a call with this event
    // window.addEventListener('chat:call', (event) => start(event.detail || {}));

    window.addEventListener('chat:call', (event) => {
        console.log('CHAT CALL RECEIVED:', event.detail);
        start(event.detail || {});
    });
}


