# SnappyMail Home Assistant Add-on

A modern, fast, and lightweight web-based email client for Home Assistant.

## About

SnappyMail is a simple, modern & fast web-based email client. It supports multiple email accounts (IMAP/SMTP), including Gmail, and runs entirely in your browser — device independent.

## Prerequisites

Before installing this add-on, make sure the following add-ons are installed and running:

### Required Add-ons

| Add-on | Purpose |
|--------|---------|
| **MariaDB** (erik73) | Required by the Mailserver add-on |
| **Mailserver** (erik73) | Provides IMAP and SMTP server (Postfix + Dovecot) |

### Add the Erik73 Repository

1. Go to **Settings → Add-ons → Add-on Store**
2. Click the three-dot menu → **Repositories**
3. Add: `https://github.com/erik73/hassio-addons`
4. Install **MariaDB** first, then **Mailserver**

## Installation

1. Go to **Settings → Add-ons → Add-on Store**
2. Click the three-dot menu → **Repositories**
3. Add: `https://github.com/gregorwolf1973/snappymail-addon`
4. Find **SnappyMail** and click **Install**

## Configuration

| Option | Description | Default |
|--------|-------------|---------|
| `admin_password` | Admin panel password | `changeme` |
| `web_port` | Port for the web UI | `8889` |
| `domain` | Your mail domain | `yourdomain.com` |
| `imap_host` | Internal IP of Mailserver container | - |
| `imap_port` | IMAP port | `993` |
| `smtp_host` | Internal IP of Mailserver container | - |
| `smtp_port` | SMTP port | `587` |
| `gmail_address` | Your Gmail address | - |
| `gmail_password` | Gmail App Password | - |
| `gmail_alias_password` | Alias password for Gmail login | - |
| `upload_max_size` | Max attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |

## Access

Open SnappyMail at: `http://[your-ha-ip]:[web_port]`

## Admin Panel

`http://[your-ha-ip]:[web_port]/?admin`

## Sidebar Integration

Add to `configuration.yaml`:

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
