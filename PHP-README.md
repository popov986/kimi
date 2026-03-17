# PHP implementation for Yellow Business template

This folder now includes a PHP layer on top of the HTML theme so you can use includes, dynamic titles, and the existing contact form handler.

## Structure

- **`public/`** – Single entry point: **`public/index.php`** is the router (clean URLs, dispatches to pages). **`public/home.php`** = home content; **about.php**, **contact.php**, **portfolio.php**, **galery.php** = other pages.
- **`includes/config.php`** – Base path, site name, page title, and optional settings.
- **`includes/header.php`** – Navigation and header. Uses clean links: `/`, `/about`, `/contact`, etc.
- **`includes/footer.php`** – Footer and scripts.

## How to run

1. From the **Template** folder, start the server with the router (single entry point in `public/`):
   ```bash
   php -S localhost:8000 public/index.php
   ```
   Then open **http://localhost:8000/** — you should see the home page. Clean URLs work: `/`, `/about`, `/contact`, `/portfolio`, `/galery`.
2. Open **`http://localhost:8000/`** in the browser. Use clean URLs:
   - `http://localhost:8000/` – Home
   - `http://localhost:8000/about` – About
   - `http://localhost:8000/contact` – Contact
   - `http://localhost:8000/portfolio` – Portfolio
   - `http://localhost:8000/galery` – Gallery

## Creating a new PHP page

1. In **`public/`**, create a new file, e.g. `my-page.php`.
2. At the top, set variables and include config + head + header (same pattern as `public/about.php`).
3. At the bottom, include the footer.
4. In **`public/index.php`**, add the new page name (e.g. `'my-page'`) to the `$allowed` array so `http://localhost:8000/my-page` works.

## Optional header bar

To show the top mini bar (phone, email, social) on a page, set before including the header:

```php
$header_mini_bar = true;
```

## Contact form

The theme’s contact form can post to the existing PHP handler:

- **Handler:** `HTWF/scripts/php/contact-form.php`
- From a page in **`pages/`**, use: `action="<?php echo BASE_PATH; ?>HTWF/scripts/php/contact-form.php"`. Set `$contact_email` in **includes/config.php** for the recipient.
 the form’s `data-email` attribute and the form’s hidden/JS payload.

The **`pages/contacts.php`** example uses this handler.

## Converting an HTML page to PHP

1. Copy the HTML file to a new `.php` file.
2. Replace the top (doctype through header) with the PHP includes as above.
3. Replace the bottom (footer and scripts) with `require_once __DIR__ . '/../includes/footer.php';`.
4. Replace any asset paths like `../images/` with `<?php echo $base; ?>images/`.
