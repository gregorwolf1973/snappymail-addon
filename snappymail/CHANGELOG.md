# Changelog

## 1.2.6 - 2026-03-22

### Fixed
- Gmail Alias Plugin correctly reads config from data directory
- Plugin created without unsupported addProperty() calls
- gmail_alias_config.json written to correct location

## 1.2.5 - 2026-03-22

### Added
- Gmail Alias Plugin auto-created by init script
- Plugin and config written to data directory on every start

## 1.2.0 - 2026-03-22

### Added
- Gmail address, password and alias password configurable in HA options
- Gmail Alias Password plugin support

## 1.1.2 - 2026-03-22

### Fixed
- Admin password now correctly set as bcrypt hash
- gmail.com removed from disabled domains list on startup

## 1.1.0 - 2026-03-22

### Added
- Configurable port, IMAP/SMTP host and port, domain
- Local mailserver and Gmail domain auto-configured on start

## 1.0.5 - 2026-03-21

### Changed
- Switched from Ingress to direct port access for better compatibility

## 1.0.0 - 2026-03-21

### Added
- Initial release
- SnappyMail 2.38.2
- Multi-account support (local mailserver + Gmail)
- Home Assistant Add-on structure
