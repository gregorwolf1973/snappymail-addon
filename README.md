# SnappyMail Home Assistant Add-on

A modern, fast, and lightweight web-based email client for Home Assistant.

## About

SnappyMail is a simple, modern & fast web-based email client. It supports multiple email accounts (IMAP/SMTP), including Gmail, and runs entirely in your browser — device independent.

## Prerequisites

Before installing this add-on, make sure the following add-ons are installed and running:

### Required Add-ons

This add-on requires a running IMAP/SMTP mail server. It has been tested with the following add-ons from the [Erik73 repository](https://github.com/erik73/hassio-addons):

| Add-on | Purpose |
|--------|---------|
| **Mailserver** (erik73) | Provides IMAP and SMTP server (Postfix + Dovecot) |
| **MariaDB** (erik73) | Required by the Mailserver add-on |

### Add the Erik73 Repository

1. Go to **Settings → Add-ons → Add-on Store**
2. Click the three-dot menu → **Repositories**
3. Add: `https://github.com/erik73/hassio-addons`
4. Install **MariaDB** first, then **Mailserver**

### Gmail Relay (optional)

If you want to send emails to external addresses (e.g. Gmail), configure Postfix as a Gmail relay. See [DOCS.md](snappymail/DOCS.md) for instructions.

### Gmail IMAP Access (optional)

To add your Gmail account in SnappyMail:
1. Enable IMAP in Gmail settings
2. Create a Gmail App Password at [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
3. Add the account in SnappyMail using your Gmail address and the App Password

## Installation

1. Go to **Settings → Add-ons → Add-on Store**
2. Click the three-dot menu (top right) → **Repositories**
3. Add this URL: `https://github.com/gregorwolf1973/snappymail-addon`
4. Find **SnappyMail** in the store and click **Install**

## Configuration

| Option | Description | Default |
|--------|-------------|---------|
| `admin_password` | Admin panel password | `changeme` |
| `web_port` | Port for the web UI | `8889` |
| `domain` | Your mail domain (e.g. `example.ddnss.de`) | - |
| `imap_host` | IMAP server IP (internal Docker IP of Mailserver) | - |
| `imap_port` | IMAP server port | `993` |
| `smtp_host` | SMTP server IP (internal Docker IP of Mailserver) | - |
| `smtp_port` | SMTP server port | `587` |
| `upload_max_size` | Max attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |

> **Note:** Use the internal Docker IP address of the Mailserver container for `imap_host` and `smtp_host` (e.g. `172.30.33.22`). You can find it with:
> ```bash
> docker inspect addon_XXXXXXXX_mailserver | grep IPAddress
> ```

## Access

After installation, open SnappyMail at:
```
http://[your-ha-ip]:[web_port]
```

## Admin Panel

Access the admin panel at:
```
http://[your-ha-ip]:[web_port]/?admin
```

## Sidebar Integration

Add SnappyMail to the Home Assistant sidebar by adding this to your `configuration.yaml`:
```yaml
panel_iframe:
  snappymail:
    title: SnappyMail
    icon: mdi:email
    url: http://[your-ha-ip]:[web_port]
```

## Documentation

See [DOCS.md](snappymail/DOCS.md) for full documentation.

## License

MIT License
