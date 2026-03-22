# SnappyMail Add-on Documentation

## About

SnappyMail is a simple, modern & fast web-based email client. It runs directly in your browser and supports multiple email accounts — including your local mailserver and Gmail.

## Prerequisites

The following add-ons from the [Erik73 repository](https://github.com/erik73/hassio-addons) must be installed and running:

- **MariaDB** — required by the Mailserver add-on
- **Mailserver** — provides IMAP and SMTP (Postfix + Dovecot)

## Installation

1. Add this repository to Home Assistant: `https://github.com/gregorwolf1973/snappymail-addon`
2. Install the **SnappyMail** add-on
3. Configure the options (see below)
4. Start the add-on
5. Open SnappyMail at `http://[your-ha-ip]:[web_port]`

## Configuration

| Option | Description | Default |
|--------|-------------|---------|
| `admin_password` | Admin panel password | `changeme` |
| `web_port` | Port for the web UI | `8889` |
| `domain` | Your mail domain | `yourdomain.com` |
| `imap_host` | Internal IP of the Mailserver container | `172.30.33.22` |
| `imap_port` | IMAP port | `993` |
| `smtp_host` | Internal IP of the Mailserver container | `172.30.33.22` |
| `smtp_port` | SMTP port | `587` |
| `gmail_address` | Your Gmail address | `your@gmail.com` |
| `gmail_password` | Gmail App Password | - |
| `gmail_alias_password` | Alias password for Gmail login | - |
| `upload_max_size` | Max attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |

> **Note:** Find the internal IP of the Mailserver container with:
> ```bash
> docker inspect addon_XXXXXXXX_mailserver | grep IPAddress
> ```

## Gmail Setup

### Enable Gmail IMAP
1. Go to Gmail settings → Forwarding and POP/IMAP
2. Enable IMAP access

### Create Gmail App Password
1. Go to [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
2. 2-Factor Authentication must be active
3. Create a new App Password → Name: "SnappyMail"
4. Enter the 16-character password as `gmail_password`

### Alias Password
Set `gmail_alias_password` to any password you want to use instead of the real App Password. SnappyMail will automatically replace it on login.

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

## Postfix mynetworks (required for sending)

After installing, add the SnappyMail container IP to Postfix's trusted networks. Add to your startup script:

```bash
docker exec addon_XXXXXXXX_mailserver postconf -e 'mynetworks = 127.0.0.0/8 172.30.33.0/24 [::1]/128 [fd0c:ac1e:2100::]/48'
docker exec addon_XXXXXXXX_mailserver postfix reload
```
