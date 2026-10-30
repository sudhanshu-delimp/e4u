
#===========Reshuffling Logic for Escort============
=> if you choose "Your Location"

PinUp -> BumpUp -> new purchase plain -> general 

general : devide by three path for reshuffling.

Front: A, B, C  => under (33%) Resuffing
Middle: D, E, F => under (33%) Resuffing
Back: G, H, I  => under (34%) Resuffing


=> if choose "Australia" Locaiton.

General Resuffing in count fornt 33% middle 33% and last 34%

		
Front: A, B, C  => under (33%) Resuffing
Middle: D, E, F => under (33%) Resuffing
Back: G, H, I  => under (34%) Resuffing

After suffling

Front: C, A, B  => under (33%) Resuffing
Middle: D, F, E => under (33%) Resuffing
Back: H, G, I  => under (34%) Resuffing

If a new listing J is added, should the positions become:

Front: J, A, B   => under (33%) Resuffing
Middle: C, D, E  => under (33%) Resuffing
Back: F, G, H, I => under (34%) Resuffing



Pin Up
 State wise : [3909, 3903, 3905, 3906, 3904, 3908, 3910, 3907]
 
Bump Up
   State wise : [3909, 3903, 3905, 3906, 3904, 3908, 3910, 3907]
 
New Listings
    State wise : [3909, 3903, 3905, 3906, 3904, 3908, 3910, 3907]
 
Listings
    State wise : [3909, 3903, 3905, 3906, 3904, 3908, 3910, 3907]
	
	
3909 -> New South Wales
3903 -> Victoria 
3905 -> Queensland 
3906 -> Western Australia
3904 -> South Australia
3908 -> Tasmania
3910 ->  Northern Territory
3907 -> Australian Capital Territory



Setup message on server 


# Chat (Messages) - Local Setup

Real-time chat between Escort, Agent and Viewer users.

Flow:

```
Browser --POST message--> Laravel (permission check + save in DB)
                              |
                              +--POST /emit (secret)--> Node socket.io server
                                                             |
Agent / Viewer browser <------ "MessageSent" event ----------+
```

- Messages are always saved by Laravel first. The Node server only relays events.
- Browsers connect to Node with a signed token created by Laravel.
- No Pusher, no Soketi, no Docker.

## 1. Requirements

| Tool | Version |
|---|---|
| PHP | 8.2 |
| Laravel | 8.x |
| Node.js | 20 LTS (use nvm; Node 24 breaks the Mix build) |
| npm | 10 |
| Composer, MySQL | any recent version |
| Windows + Laragon | site runs at `http://e4u_dev.local` |

Check versions:

```bash
php -v
node -v
npm -v
```

Install Node 20 with nvm if needed:

```bash
nvm install 20
nvm use 20
```

## 2. Get the code

```bash
git clone <repo-url> e4u_dev
cd e4u_dev
git checkout delimp-dev
```

## 3. Install dependencies

```bash
composer install
npm install --legacy-peer-deps
```

## 4. Environment

```bash
cp .env.example .env      # skip if you already have a .env
php artisan key:generate  # skip if APP_KEY is already set
```

Set database credentials in `.env`, then add the chat variables:

```env
BROADCAST_DRIVER=chatsocket
CHAT_SOCKET_PORT=6002
CHAT_SOCKET_URL=http://127.0.0.1:6002
CHAT_SOCKET_PUBLIC_URL=http://127.0.0.1:6002
CHAT_SOCKET_ORIGINS=http://e4u_dev.local
CHAT_SOCKET_SECRET=<random-secret>
```

Generate the secret:

```bash
node -e "console.log(require('crypto').randomBytes(24).toString('hex'))"
```

| Variable | Meaning |
|---|---|
| `CHAT_SOCKET_URL` | URL Laravel uses to reach Node (server side) |
| `CHAT_SOCKET_PUBLIC_URL` | URL the browser connects to |
| `CHAT_SOCKET_ORIGINS` | Exact site URL allowed by CORS, no trailing slash. Comma separate for more than one |
| `CHAT_SOCKET_SECRET` | Shared secret. Laravel and Node read the same `.env`, so it always matches |

## 5. Database and storage

```bash
php artisan migrate
php artisan storage:link
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

The migration creates only the new `chat_*` tables. Never run `migrate:fresh` on a shared database.

## 6. Build the chat JavaScript

```bash
npm run chat
```

This creates `public/chat-build/js/chat.js`. The file is committed to git, so the server does not need to build it.

Do not run `npm run dev`. The old `webpack.mix.js` has `.vue()` and `.sass()` steps for packages that are not installed. Chat uses its own config: `webpack.mix.chat.js`.

During development you can use `npm run chat-watch`.

## 7. Run the chat socket server

Open a separate terminal and keep it running:

```bash
npm run node-server
```

Expected output: `Chat socket on 6002`.

Check it:

```bash
curl http://127.0.0.1:6002/health
```

Expected: `{"ok":true,"online":0}`.

## 8. Test

1. Open `http://e4u_dev.local` (use `http`, not `https`) and log in.
2. Open the Messages page.
3. Log in as a second user in another browser or an incognito window.
4. Send a message from one user. It must appear in the other browser without reload.
5. Run `curl http://127.0.0.1:6002/health`. It should show `"online":2`.

Browser check: F12 > Network > Socket. A `socket.io` row should show status `101`.

## 9. Daily start

```bash
# terminal 1
npm run node-server

# site runs from Laragon (start Laragon)
```

Run `npm run chat` again only when you change files in `resources/js/chat/`.

## 10. Troubleshooting

| Problem | Cause and fix |
|---|---|
| Console: `Socket error: unauthorized` | `CHAT_SOCKET_SECRET` is missing or changed. Restart the Node server and run `php artisan config:clear` |
| CORS error in console | `CHAT_SOCKET_ORIGINS` does not match the site URL exactly |
| Message saved but not live | Node server is not running, or `BROADCAST_DRIVER` is not `chatsocket`. Check `storage/logs/laravel.log` for `Chat socket emit failed` |
| `/health` shows `online: 0` | Browser is not connected. Check the Network > Socket row and the console |
| `Target [Illuminate\Contracts\Broadcasting\Factory] is not instantiable` | `Illuminate\Broadcasting\BroadcastServiceProvider` is missing in `config/app.php` |
| `Cannot find module 'webpack/lib/SizeFormatHelpers'` | Run `npm install --save-dev webpack@5.88.2 --legacy-peer-deps` |
| `Missing script: "node-server"` | `package.json` is missing the script `"node-server": "node node-server/server.js"` |
| Page redirects to `/` | You are not logged in, or the project's `DemoBasicAuth` middleware is asking for credentials |
| Port 6002 already in use | Change `CHAT_SOCKET_PORT`, `CHAT_SOCKET_URL` and `CHAT_SOCKET_PUBLIC_URL` to a free port |
| Browser blocks `ws://` | The page is open on `https`. Use `http` locally |

Note: the old `socket-server.js` in the project uses port 6001. Chat uses port 6002, so they do not clash.

## 11. Important files

| File | Purpose |
|---|---|
| `node-server/server.js` | Node socket.io server (relay, token check, online status) |
| `app/Services/ChatSocket.php` | Creates signed tokens and sends events to Node |
| `app/Broadcasting/SocketBroadcaster.php` | Custom Laravel broadcast driver (`chatsocket`) |
| `app/Providers/AppServiceProvider.php` | Registers the `chatsocket` driver |
| `config/broadcasting.php` | `chatsocket` connection |
| `config/chat.php` | Chat rules and socket config |
| `app/Events/*` | MessageSent, MessageChanged, MessagesRead, UserTyping, UserOffline |
| `app/Http/Controllers/ChatController.php` | Chat API |
| `resources/views/components/chat/index.blade.php` | Chat component and `data-config` |
| `resources/js/chat/` | Frontend source (`controller.js`, `socket.js`, `render.js`, `api.js`, `actions.js`) |
| `webpack.mix.chat.js` | Chat-only build config |
| `public/chat-build/` | Built JavaScript (commit this) |

## 12. Staging / production

The same code runs on a server. Only `.env` changes.

```env
BROADCAST_DRIVER=chatsocket
CHAT_SOCKET_PORT=6002
CHAT_SOCKET_URL=http://127.0.0.1:6002
CHAT_SOCKET_PUBLIC_URL=https://<your-domain>
CHAT_SOCKET_ORIGINS=https://<your-domain>
CHAT_SOCKET_SECRET=<new-random-secret>
```

Deploy steps:

```bash
git pull origin <branch>
composer install --no-dev --optimize-autoloader
npm install --omit=dev
php artisan migrate --force
php artisan storage:link
php artisan config:clear && php artisan view:clear && php artisan route:clear

pm2 start node-server/server.js --name chat-socket
pm2 save
```

After changing `.env`, run `pm2 restart chat-socket --update-env`.

The browser must reach Node over `wss://<your-domain>/socket.io/`. This needs a reverse proxy with WebSocket upgrade:

- Proxy `/socket.io/` to `http://127.0.0.1:6002/socket.io/` (path must stay `/socket.io/`).
- Do not open port 6002 to the internet.
- Use a different `CHAT_SOCKET_SECRET` on each environment.
- If the host cannot proxy, a tunnel such as ngrok can be used for staging only. Set `CHAT_SOCKET_PUBLIC_URL` to the tunnel URL.

## 13. Safety notes

- Never commit `.env`.
- Do not run `npm run chat` on the server. Build locally and commit `public/chat-build/`.
- Do not run `migrate:fresh` or `db:wipe`.
- Take a database and `.env` backup before deploying.
