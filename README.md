# SnappyMail Home Assistant Add-on

A modern, fast, and lightweight web-based email client for Home Assistant.

## About

SnappyMail is a simple, modern & fast web-based email client. It supports multiple email accounts (IMAP/SMTP), including Gmail, and runs entirely in your browser — device independent.

SnappyMail does **not** require a database. All data is stored in files.

---

## Prerequisites

### Option A: Local mailserver (own domain)

If you want to use your own mail domain, install these add-ons from the [Erik73 repository](https://github.com/erik73/hassio-addons):

| Add-on | Purpose |
|--------|---------|
| **MariaDB** (erik73) | Required by the Mailserver add-on |
| **Mailserver** (erik73) | Provides IMAP and SMTP (Postfix + Dovecot) |

Add the Erik73 repository:
1. **Settings → Add-ons → Add-on Store → ⋮ → Repositories**
2. Add: `https://github.com/erik73/hassio-addons`
3. Install **MariaDB** first, then **Mailserver**

### Option B: Gmail only

No additional add-ons needed. Configure your Gmail credentials in the SnappyMail settings.

---

## Installation

1. **Settings → Add-ons → Add-on Store → ⋮ → Repositories**
2. Add: `https://github.com/gregorwolf1973/snappymail-addon`
3. Find **SnappyMail** and click **Install**
4. Configure the options (see below)
5. Start the add-on

---

## Configuration

### General Settings

| Option | Description | Default |
|--------|-------------|---------|
| `web_port` | Port for the web UI | `8889` |
| `upload_max_size` | Max attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |

---

### Local Mailserver Settings

> Only needed if you use a local mailserver (Option A)

| Option | Description | Default |
|--------|-------------|---------|
| `domain` | Your mail domain (e.g. `yourdomain.com`) | `yourdomain.com` |
| `imap_host` | Internal Docker IP of the Mailserver container | `172.30.33.22` |
| `imap_port` | IMAP port | `993` |
| `smtp_host` | Internal Docker IP of the Mailserver container | `172.30.33.22` |
| `smtp_port` | SMTP port | `587` |

> **Find the internal IP of the Mailserver container:**
> ```bash
> docker inspect addon_XXXXXXXX_mailserver | grep IPAddress
> ```

---

### Gmail Settings

> Only needed if you want to use Gmail

| Option | Description |
|--------|-------------|
| `gmail_address` | Your Gmail address |
| `gmail_password` | Gmail App Password (not your regular Gmail password!) |
| `gmail_alias_password` | A custom alias password you can use instead of the App Password |

#### Create a Gmail App Password
1. Go to [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
2. 2-Factor Authentication must be active
3. Create a new App Password → Name: "SnappyMail"
4. Enter the 16-character password as `gmail_password`

#### Alias Password
Set `gmail_alias_password` to any password you choose. SnappyMail will automatically replace it with the real App Password on login — so you never have to type the App Password in the browser.

---

## First Start & Admin Panel

After installation, you need to set the admin password once. Tip to Terminal:
```bash
docker exec addon_XXXXXXXX_snappymail sh -c "HASH=\$(php84 -r \"echo password_hash('changeme', PASSWORD_BCRYPT);\") && sed -i \"s|admin_password = .*|admin_password = \\\"\$HASH\\\"|\" /var/www/snappymail/data/_data_/_default_/configs/application.ini"
```

Then open the admin panel and change the password immediately:
```
http://[your-ha-ip]:[web_port]/?admin
```

In the admin panel you can:
- Change the admin password under **Security**
- Manage domain configurations
- Enable/disable plugins --> enable Gmail Alias-Plugin

> **Important:** Change the admin password immediately after first login!

---

## Access
```
http://[your-ha-ip]:[web_port]
```

---

## Sidebar Integration

### Option 1: Nginx Proxy Manager (recommended for HA sidebar)

Set up a proxy host in Nginx Proxy Manager:

1. **Domain:** e.g. `webmail.yourdomain.com`
2. **Scheme:** `http`
3. **Forward Hostname:** `homeassistant.local`
4. **Forward Port:** your configured `web_port`
5. **SSL:** Enable Let's Encrypt

Under **Advanced**, add:
```nginx
proxy_hide_header X-Frame-Options;
proxy_hide_header Content-Security-Policy;
add_header X-Frame-Options "SAMEORIGIN";
proxy_set_header X-Forwarded-Proto $scheme;
proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
proxy_set_header Host $host;
```

Then add a Dashboard iFrame card in HA pointing to `https://webmail.yourdomain.com`.

> **Note:** Always access SnappyMail via the same URL to avoid HTTP Token Mismatch errors.

### Option 2: Direct browser tab
```
http://[your-ha-ip]:[web_port]
```

---

## Postfix mynetworks (required for sending with local mailserver)

After installing SnappyMail, add its container to Postfix trusted networks.
Add to your startup script (`/config/startup/startup.d/`):
```bash
docker exec addon_XXXXXXXX_mailserver postconf -e 'mynetworks = 127.0.0.0/8 172.30.33.0/24 [::1]/128 [fd0c:ac1e:2100::]/48'
docker exec addon_XXXXXXXX_mailserver postfix reload
```

---

## Documentation

See [DOCS.md](snappymail/DOCS.md) for full documentation.

## License

MIT License
