# README.md

Here's a complete README file for the **Deep Architects** website project. Save this as `README.md` in the root of your project folder.

```markdown
# Deep Architects — Official Website

> Modern, responsive website for **Deep Architects**, a leading architecture firm based in Dewas, Madhya Pradesh, India. Founded by **Rupesh Singh Chawda (B.Arch)**, specializing in residential, commercial, and interior design projects.

![Deep Architects](images/deeplogo.jpeg)

---

## 📖 Table of Contents

- [About the Project](#-about-the-project)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Pages Overview](#-pages-overview)
- [Getting Started](#-getting-started)
- [Configuration](#-configuration)
- [Customization](#-customization)
- [Analytics & Tracking](#-analytics--tracking)
- [Contact Form Setup](#-contact-form-setup)
- [Deployment](#-deployment)
- [Performance & SEO](#-performance--seo)
- [Credits](#-credits)
- [License](#-license)

---

## 🏛 About the Project

Deep Architects is a professional architecture firm offering:

- **Architectural Design** — Concept to completion
- **Residential Design** — Custom homes, villas, penthouses
- **Commercial Design** — Offices, retail, hotels, restaurants
- **Interior Design** — Modern, functional, elegant spaces
- **Urban Planning** — Sustainable city planning
- **Construction Supervision** — On-site project management

The website serves as the firm's digital portfolio, providing:
- Project showcases and case studies
- Design philosophy and process
- Team information
- Career opportunities
- Direct client communication

---

## ✨ Features

- ✅ **Fully responsive** — Works on mobile, tablet, desktop
- ✅ **Modern UI/UX** — Custom design with smooth animations
- ✅ **Hero sliders** — Auto-rotating image carousels
- ✅ **Portfolio filtering** — Category-based project filtering
- ✅ **Interactive modals** — Detailed project views
- ✅ **Contact forms** — Powered by Web3Forms
- ✅ **Career application** — CV upload with file validation
- ✅ **Newsletter signup** — Email collection forms
- ✅ **Google Maps** — Embedded location
- ✅ **SEO optimized** — Meta tags, Open Graph, structured data
- ✅ **Analytics tracking** — SheetDB + Cloudflare insights
- ✅ **Chatbot integration** — Chatbase AI assistant
- ✅ **Smooth scrolling & animations** — AOS library
- ✅ **Accessibility-friendly** — Semantic HTML, ARIA labels

---

## 🛠 Tech Stack

### Frontend
| Technology | Purpose |
|---|---|
| **HTML5** | Structure & semantic markup |
| **CSS3** | Styling, custom properties (CSS variables), flexbox, grid |
| **JavaScript (Vanilla)** | Interactivity, DOM manipulation, form handling |
| **Google Fonts** | Playfair Display, Poppins |
| **Font Awesome 6.4** | Icons |

### Libraries & CDNs
| Library | Purpose |
|---|---|
| **AOS 2.3.1** | Scroll animations |
| **Glide.js 3.5** | Testimonial carousel |
| **jQuery 3.6** | Legacy support (portfolio page) |

### Third-Party Services
| Service | Purpose |
|---|---|
| **Web3Forms** | Contact form submissions |
| **SheetDB** | Visitor analytics |
| **Cloudflare Insights** | Web analytics |
| **Chatbase** | AI chatbot |
| **ipapi.co** | Visitor geolocation |
| **Unsplash** | Placeholder images |

---

## 📁 Project Structure

```
deep-architects/
│
├── index.html              # Homepage (hero, about, services, team, milestones, testimonials)
├── about.html              # About Us (story, founders, mission, gallery)
├── design.html             # Design services (principles, portfolio, process)
├── projects.html           # Projects (commercial, residential, landscape, management)
├── contact.html            # Contact (form, map, business hours)
├── careers.html            # Careers (openings, application form)
├── privacy.html            # Privacy Policy
├── sitemap.html            # Site Map
├── terms.html              # Terms of Service (optional)
│
├── styles.css              # (Optional) Shared base styles
├── script.js               # (Optional) Shared scripts
│
├── images/
│   ├── deeplogo.jpeg       # Favicon / logo
│   ├── rk.jpg              # Founder photo
│   ├── ritura.jpeg         # Team member
│   ├── rajf.jpeg           # Team member
│   ├── com.png             # Commercial project
│   ├── contruct.png        # Construction image
│   ├── Coordination.png    # Team coordination
│   ├── handover.png        # Project handover
│   ├── water.png           # Water feature
│   ├── 4.png               # Blueprint
│   ├── cln1.jpeg           # Client testimonial
│   ├── cln2.jpeg           # Client testimonial
│   ├── clnp.jpeg           # Client testimonial
│   └── clns.jpeg           # Client testimonial
│
└── README.md               # This file
```

---

## 📄 Pages Overview

| Page | File | Description |
|---|---|---|
| **Home** | `index.html` | Hero slider, about intro, services, team, milestones counters, testimonials, contact preview |
| **About** | `about.html` | Company story, founders bio, mission statements, project gallery |
| **Design** | `design.html` | Design principles (balance, context, sustainability), portfolio, 5-step process |
| **Projects** | `projects.html` | 4 categories: Commercial, Residential, Landscape, Project Management |
| **Contact** | `contact.html` | Contact form (Web3Forms), Google Map, business hours, social links |
| **Careers** | `careers.html` | Why work with us, current openings, application form with CV upload |
| **Privacy** | `privacy.html` | Full privacy policy covering data collection, cookies, user rights |
| **Sitemap** | `sitemap.html` | Organized page directory with icons |

---

## 🚀 Getting Started

### Prerequisites
- Any modern web browser (Chrome, Firefox, Safari, Edge)
- A code editor (VS Code, Sublime Text, etc.)
- (Optional) A local web server for testing

### Installation

1. **Clone or download the project:**
   ```bash
   git clone https://github.com/your-username/deep-architects.git
   cd deep-architects
   ```

2. **Open locally:**
   - **Option A (simple):** Double-click `index.html` to open in your browser
   - **Option B (recommended):** Run a local server:
     ```bash
     # Python 3
     python -m http.server 8000

     # Node.js (with http-server)
     npx http-server

     # PHP
     php -S localhost:8000
     ```
   - Visit `http://localhost:8000`

### File Requirements
- Ensure all images are in the `images/` folder
- Verify image paths match the references in HTML files
- Test all internal links point to existing `.html` files

---

## ⚙️ Configuration

### 1. Contact Form (Web3Forms)

The contact form on `contact.html` uses **Web3Forms**. To make it work:

1. Go to [web3forms.com](https://web3forms.com)
2. Sign up with `contact@deeparchitect.in`
3. Copy your access key
4. Replace in `contact.html`:
   ```html
   <input type="hidden" name="access_key" value="YOUR_ACCESS_KEY_HERE">
   ```

### 2. Newsletter Form

Currently uses a `mailto:` fallback. To enable actual submissions:
- **Option A:** Use Mailchimp embedded form
- **Option B:** Use Formspree or Web3Forms
- **Option C:** Build a backend endpoint

### 3. Chatbot (Chatbase)

The chatbot is embedded in all pages. To use your own:
1. Create an account at [chatbase.co](https://chatbase.co)
2. Build your AI agent
3. Copy the embed script
4. Replace the `script.id` value in all HTML pages

### 4. Analytics (SheetDB)

Visitor tracking uses SheetDB API. To set up your own:

1. Create a Google Sheet with columns:
   `type | page | referrer | browser | screen | language | timezone | device | visit_time | ip | city | region | country | element | id | class | seconds | percent`

2. Go to [sheetdb.io](https://sheetdb.io) and create an API
3. Replace the endpoint in `index.html` (or wherever analytics is loaded):
   ```javascript
   const ANALYTICS_ENDPOINT = 'https://sheetdb.io/api/v1/YOUR_API_ID';
   ```

### 5. Google Maps

The map embed on `contact.html` uses a static embed URL. To customize:

1. Go to [Google Maps](https://maps.google.com)
2. Search your location
3. Click **Share → Embed a map**
4. Copy the `<iframe>` code
5. Replace the existing iframe in `contact.html`

---

## 🎨 Customization

### Colors

Edit the CSS variables in each page's `<style>` block (or in `styles.css`):

```css
:root {
    --primary-color: #d4af37;   /* Gold — change to your brand color */
    --secondary-color: #333333; /* Dark gray */
    --light-color: #f8f8f8;     /* Light gray */
    --dark-color: #222222;      /* Near black */
    --text-color: #555555;      /* Body text */
    --white: #ffffff;
}
```

### Fonts

Currently using:
- **Headings:** Playfair Display (serif)
- **Body:** Poppins (sans-serif)

Change in each page's `<head>`:
```html
<link href="https://fonts.googleapis.com/css2?family=Your+Heading+Font&family=Your+Body+Font&display=swap" rel="stylesheet">
```
Then update:
```css
h1, h2, h3, h4, h5, h6 {
    font-family: 'Your Heading Font', serif;
}
body {
    font-family: 'Your Body Font', sans-serif;
}
```

### Logo

Replace `images/deeplogo.jpeg` with your own logo (recommended: square, 512×512px).

### Text Content

All text is inline in HTML. Search for phrases and replace:
- Company name: `Deep Architects` / `DEEPARCHITECTS`
- Founder: `Rupesh Singh Chawda`
- Address: `100/2, Deep Tower, Mishrilal Nagar, Kaila Devi Road, Dewas, 455001 (M.P.)`
- Phone: `9977822952`
- Email: `contact@deeparchitect.in`

### Social Links

Update across all pages:
```html
<a href="https://www.facebook.com/YOUR_PAGE">...</a>
<a href="https://www.instagram.com/YOUR_HANDLE/">...</a>
<a href="https://www.linkedin.com/in/YOUR_PROFILE/">...</a>
```

---

## 📊 Analytics & Tracking

The site includes:

### 1. **Visitor Tracking** (SheetDB)
- Page views
- Click events
- Scroll depth (25%, 50%, 75%, 100%)
- Time spent on page
- Referrer, browser, device, location

### 2. **Cloudflare Web Analytics**
```html
<script defer src='https://static.cloudflareinsights.com/beacon.min.js'
        data-cf-beacon='{"token": "YOUR_TOKEN"}'></script>
```

### 3. **Google Search Console**
Meta verification in `index.html`:
```html
<meta name="google-site-verification" content="YOUR_CODE" />
```

### 4. **Bing Webmaster**
```html
<meta name="msvalidate.01" content="YOUR_CODE" />
```

---

## 📬 Contact Form Setup

### Web3Forms (Recommended — Free)

1. Register at [web3forms.com](https://web3forms.com)
2. Verify your email
3. Create an access key
4. Paste into the form:

```html
<form action="https://api.web3forms.com/submit" method="POST">
    <input type="hidden" name="access_key" value="YOUR_KEY">
    <input type="hidden" name="subject" value="New enquiry from website">
    <input type="hidden" name="from_name" value="Deep Architects Website">
    <!-- form fields -->
</form>
```

### Careers Form

The careers page uses a **simulated backend** (JavaScript only). To make it functional:

1. **Option A: Formspree**
   ```html
   <form action="https://formspree.io/f/YOUR_FORM_ID" method="POST" enctype="multipart/form-data">
   ```

2. **Option B: Custom PHP backend**
   ```php
   // upload.php
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       // handle file upload + email
   }
   ```

3. **Option C: Google Forms / Typeform** — Embed the form directly

---

## 🌐 Deployment

### Static Hosting (Recommended)

**Netlify:**
```bash
# Drag & drop the folder at netlify.com/drop
# Or use Netlify CLI:
npm install -g netlify-cli
netlify deploy --prod
```

**Vercel:**
```bash
npm install -g vercel
vercel --prod
```

**GitHub Pages:**
1. Push to GitHub
2. Go to **Settings → Pages**
3. Select branch: `main` → `/root`
4. Visit `https://your-username.github.io/deep-architects`

**Cloudflare Pages:**
1. Connect GitHub repo
2. Build command: (none)
3. Output directory: `/` (root)

### Traditional Hosting (cPanel, Hostinger, etc.)

1. Compress all files into `deep-architects.zip`
2. Upload via FTP/cPanel File Manager to `public_html/`
3. Extract
4. Update DNS if needed

### Domain Setup

Point `deeparchitect.in` to your hosting:
- **A Record:** `@` → your server IP
- **CNAME:** `www` → `deeparchitect.in`
- Enable HTTPS/SSL (Let's Encrypt via hosting panel)

---

## 🚀 Performance & SEO

### Already Implemented
- ✅ Meta descriptions on all pages
- ✅ Open Graph tags (Facebook, LinkedIn)
- ✅ Twitter Card tags
- ✅ Canonical URLs
- ✅ JSON-LD structured data (Organization, Person, LocalBusiness)
- ✅ Semantic HTML5
- ✅ Lazy-loaded images (add `loading="lazy"` to improve)
- ✅ Mobile viewport meta

### Recommended Improvements
- [ ] Convert images to **WebP** format
- [ ] Add `loading="lazy"` to all below-fold images
- [ ] Minify CSS & JS for production
- [ ] Add `sitemap.xml` and `robots.txt`
- [ ] Enable **GZIP/Brotli** compression
- [ ] Add **Service Worker** for offline support
- [ ] Optimize hero images (use `<picture>` with srcset)

### Create `robots.txt`
```
User-agent: *
Allow: /
Sitemap: https://deeparchitect.in/sitemap.xml
```

### Create `sitemap.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc>https://deeparchitect.in/</loc><priority>1.0</priority></url>
  <url><loc>https://deeparchitect.in/about.html</loc><priority>0.9</priority></url>
  <url><loc>https://deeparchitect.in/design.html</loc><priority>0.9</priority></url>
  <url><loc>https://deeparchitect.in/projects.html</loc><priority>0.9</priority></url>
  <url><loc>https://deeparchitect.in/contact.html</loc><priority>0.8</priority></url>
  <url><loc>https://deeparchitect.in/careers.html</loc><priority>0.7</priority></url>
  <url><loc>https://deeparchitect.in/privacy.html</loc><priority>0.5</priority></url>
</urlset>
```

---

## 🧪 Browser Support

| Browser | Version | Status |
|---|---|---|
| Chrome | 90+ | ✅ Fully supported |
| Firefox | 88+ | ✅ Fully supported |
| Safari | 14+ | ✅ Fully supported |
| Edge | 90+ | ✅ Fully supported |
| Opera | 76+ | ✅ Fully supported |
| IE 11 | — | ❌ Not supported |

---

## 🤝 Contributing

This is a private project for **Deep Architects**. For modifications:

1. Create a feature branch: `git checkout -b feature/new-section`
2. Commit changes: `git commit -m "Add new section"`
3. Push: `git push origin feature/new-section`
4. Open a Pull Request

---

## 🐛 Known Issues & TODOs

- [ ] Newsletter forms currently show an alert (no backend)
- [ ] Careers form uses simulated submission (needs backend)
- [ ] Some Unsplash placeholder images should be replaced with real project photos
- [ ] Blog page is linked in sitemap but not yet created
- [ ] FAQ page is linked in sitemap but not yet created
- [ ] Terms of Service page separate from Privacy Policy not yet created

---

## 📞 Contact

**Deep Architects**
- 📍 100/2, Deep Tower, Mishrilal Nagar, Kaila Devi Road, Dewas, 455001 (M.P.)
- 📞 +91 99778 22952
- 📧 contact@deeparchitect.in
- 🌐 [deeparchitect.in](https://deep.rajvardhansingh.in)

**Principal Architect:** Rupesh Singh Chawda (B.Arch)

**Developer:** Rajvardhan Singh — [rajvardhansingh.in](https://rajvardhansingh.in)

---

## 📄 License

© 2026 **Deep Architects**. All Rights Reserved.

This website and its content are the property of Deep Architects. Unauthorized reproduction, distribution, or use of any materials is prohibited without prior written permission.

Third-party libraries and services are used under their respective licenses:
- Font Awesome — [Font Awesome Free License](https://fontawesome.com/license/free)
- AOS — [MIT License](https://github.com/michalsnik/aos/blob/master/LICENSE)
- Glide.js — [MIT License](https://github.com/glidejs/glide/blob/master/LICENSE)
- Google Fonts — [Open Font License](https://fonts.google.com/)

---

## 🙏 Credits

- **Design & Development:** Rajvardhan Singh
- **Content & Branding:** Deep Architects Team
- **Photography:** Unsplash contributors (placeholders)
- **Icons:** Font Awesome
- **Hosting:** Cloudflare Pages / Netlify (recommended)

---

<div align="center">

**Made with ❤️ for Deep Architects**

⭐ Star this repo if you find it useful!

</div>
```

---

## 💾 How to Use This README

1. **Save as `README.md`** in the root of your project folder
2. **Replace placeholders:**
   - `YOUR_ACCESS_KEY_HERE` → your Web3Forms key
   - `YOUR_API_ID` → your SheetDB API ID
   - `YOUR_TOKEN` → your Cloudflare token
   - `your-username` → your GitHub username
3. **Update contact info** if anything changes
4. **Commit to Git** — it will render on GitHub automatically

The README gives anyone (client, developer, future maintainer) a complete guide to understand, run, and customize the website. 🚀
