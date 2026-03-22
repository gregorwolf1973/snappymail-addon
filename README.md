# SnappyMail Home Assistant Add-on

A modern, fast, and lightweight web-based email client for Home Assistant.

## About

SnappyMail is a simple, modern & fast web-based email client. It supports multiple email accounts (IMAP/SMTP), including Gmail, and runs entirely in your browser — device independent.

SnappyMail itself does **not** require a database. It stores all data in files.

## Prerequisites

### Option A: Local mailserver (own domain)

If you want to use your own mail domain, you need the following add-ons from the [Erik73 repository](https://github.com/erik73/hassio-addons):

| Add-on | Purpose |
|--------|---------|
| **MariaDB** (erik73) | Required by the Mailserver add-on (for PostfixAdmin) |
| **Mailserver** (erik73) | Provides IMAP and SMTP server (Postfix + Dovecot) |

Add the Erik73 repository:
1. Go to **Settings → Add-ons → Add-on Store**
2. Click the three-dot menu → **Repositories**
3. Add: `https://github.com/erik73/hassio-addons`
4. Install **MariaDB** first, then **Mailserver**

### Option B: Gmail only

If you only want to use Gmail, you do **not** need any additional add-ons. Just configure your Gmail credentials in the SnappyMail settings.

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
| `domain` | Your mail domain (only needed with local mailserver) | `yourdomain.com` |
| `imap_host` | Internal Docker IP of Mailserver container | `172.30.33.22` |
| `imap_port` | IMAP port | `993` |
| `smtp_host` | Internal Docker IP of Mailserver container | `172.30.33.22` |
| `smtp_port` | SMTP port | `587` |
| `gmail_address` | Your Gmail address | - |
| `gmail_password` | Gmail App Password | - |
| `gmail_alias_password` | Alias password for Gmail login (optional) | - |
| `upload_max_size` | Max attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |

> **Note:** To find the internal IP of the Mailserver container:
> ```bash
> docker inspect addon_XXXXXXXX_mailserver | grep IPAddress
> ```

## Gmail Setup

### Enable Gmail IMAP
1. Go to Gmail → Settings → Forwarding and POP/IMAP
2. Enable IMAP access

### Create Gmail App Password
1. Go to [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
2. 2-Factor Authentication must be active
3. Create a new App Password → Name: "SnappyMail"
4. Enter the 16-character password as `gmail_password`

### Alias Password (optional)
Set `gmail_alias_password` to any password you want to use instead of the real App Password. SnappyMail will automatically replace it on login — so you never have to enter your real App Password in the browser.

## Access
```
http://[your-ha-ip]:[web_port]
```

## Admin Panel
```
http://[your-ha-ip]:[web_port]/?admin
```

## Sidebar Integration

Add to `configuration.yaml`:
```yaml
panel_iframe:
  snappymail:
    title: SnappyMail
    icon: mdi:email
    url: http://[your-ha-ip]:[web_port]
```

## Postfix mynetworks (required for sending with local mailserver)

After installing SnappyMail, add its container IP to Postfix trusted networks. Add to your startup script:
```bash
docker exec addon_XXXXXXXX_mailserver postconf -e 'mynetworks = 127.0.0.0/8 172.30.33.0/24 [::1]/128 [fd0c:ac1e:2100::]/48'
docker exec addon_XXXXXXXX_mailserver postfix reload
```

## Documentation

See [DOCS.md](snappymail/DOCS.md) for full documentation.

## License

MIT License
