# SnappyMail Home Assistant Add-on

A modern, fast, and lightweight web-based email client for Home Assistant.

## About

SnappyMail is a simple, modern & fast web-based email client. It supports multiple email accounts (IMAP/SMTP), including Gmail, and runs entirely in your browser — device independent.

## Installation

1. Go to **Settings → Add-ons → Add-on Store**
2. Click the three-dot menu (top right) → **Repositories**
3. Add this URL: `https://github.com/gregorwolf1973/snappymail-addon`
4. Find **SnappyMail** in the store and click **Install**

## Features

- 📧 Multi-account support (Gmail, local mailserver, etc.)
- 🌐 Web-based — works on any device
- 🔒 Secure IMAP/SMTP connections
- 📎 Attachment support
- 🎨 Modern, clean UI

## Configuration

| Option | Description | Default |
|--------|-------------|---------|
| `admin_password` | Admin panel password | `changeme` |
| `web_port` | Port for the web UI | `8889` |
| `domain` | Your mail domain | - |
| `imap_host` | IMAP server address | - |
| `imap_port` | IMAP server port | `993` |
| `smtp_host` | SMTP server address | - |
| `smtp_port` | SMTP server port | `587` |
| `upload_max_size` | Max attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |

## Admin Panel

Access the admin panel at: `http://[your-ha-ip]:[web_port]/?admin`

## Documentation

See [DOCS.md](snappymail/DOCS.md) for full documentation.

## License

MIT License
