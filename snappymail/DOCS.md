# SnappyMail Add-on Documentation

## About

SnappyMail is a simple, modern & fast web-based email client. It runs directly in your browser and supports multiple email accounts — including your local mailserver and Gmail.

## Installation

1. Add this repository to Home Assistant:
   `https://github.com/gregorwolf1973/snappymail-addon`
2. Install the **SnappyMail** add-on
3. Configure the options (see below)
4. Start the add-on
5. Open the Web UI via the **SnappyMail** panel in the sidebar

## Configuration

### Options

| Option | Description | Default |
|--------|-------------|---------|
| `admin_password` | Password for the SnappyMail admin panel | `changeme` |
| `upload_max_size` | Maximum attachment size | `25M` |
| `memory_limit` | PHP memory limit | `128M` |
| `log_to_stdout` | Log to Home Assistant log | `false` |

**⚠️ Change `admin_password` before first use!**

## First Login

1. Open SnappyMail from the sidebar
2. Log in with your email address and password:
   - Local server: `yourname@yourdomain.whatever`
   - Gmail: `your_gmail_adress@gmail.com`

## Adding Gmail Account

1. Log in to SnappyMail with your local account first
2. Click the user icon (top right) → **Add Account**
3. Enter your Gmail address: `yourname@gmail.com`
4. Enter your Gmail **App Password** (not your normal password!)

### Creating a Gmail App Password

1. Go to [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
2. 2-Factor Authentication must be enabled
3. Create a new App Password → Name: "SnappyMail"
4. Use the 16-character password in SnappyMail

## Admin Panel

Access the admin panel at: `http://[your-ha-ip]:8888/?admin`

Use the `admin_password` you configured in the add-on options.

In the admin panel you can:
- Manage domain configurations (IMAP/SMTP settings)
- Configure security settings
- View logs

## Pre-configured Domains

The following domains are pre-configured automatically:

- **dynamic.dns.provider** — your local mailserver (IMAP port 993, SMTP port 587)
- **gmail.com** — Gmail (IMAP port 993, SMTP port 587)

## Troubleshooting

### Cannot connect to Gmail
- Make sure IMAP is enabled in Gmail settings
- Use an App Password, not your regular Gmail password
- 2-Factor Authentication must be active on your Google account

### Cannot connect to local mailserver
- Verify the Mailserver add-on is running
- Check that the domain `dynamic.dns.provider` is correct

### Forgot admin password
- Change `admin_password` in the add-on options and restart
