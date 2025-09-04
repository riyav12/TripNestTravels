# TripNestTravels (Dag Aasbø Travel – Custom WordPress Theme)

This repository contains the **custom theme** for the TripNestTravels project.

## 📂 Project Structure
repo-root/
├─ .gitignore
└─ wp-content/
   └─ themes/
      └─ dag-aasbo-travel/   <-- custom theme (tracked here)

## 📦 Required Plugins
- Advanced Custom Fields (ACF)
- Advanced Custom Fields PRO
- WooCommerce
- YITH WooCommerce Wishlist
- WooCommerce Stripe Gateway
- WooCommerce PayPal Payments
- PDF Invoices & Packing Slips for WooCommerce

## ⚡ Recommended Plugins
- WP Mail SMTP
- Safe SVG
- Pinterest for WooCommerce

## 🛠 Development & Migration Plugins
- Duplicator
- NS Cloner
- WordPress Importer

## 🧩 Custom Plugin
- **Riya Custom Plugin** – custom shortcode & offer popup

## 🚀 Local Setup
1. Install WordPress locally (XAMPP).
2. Copy this theme folder into: `wp-content/themes/dag-aasbo-travel`
3. Install & activate the plugins above.
4. In WP Admin → Appearance → Themes, activate **Dag Aasbø Travel**.
5. Configure ACF fields and WooCommerce.

**Note:** Make sure your local server (XAMPP) is running before setup.

## 🌿 Branching Workflow
- `dev` → development branch  
- `feature/*` → for new features (example: `feature/homepage`)

### Commands:
```bash
git checkout dev
git pull origin dev
git checkout -b feature/<your-task>
# work & commit
git push -u origin feature/<your-task>
```
## Author
**Riya Verlekar**
