## Exporting for UM

1. View the source for the root splash page, and save this to `index.html`
2. View the source for `/desktop` and save this to `desktop.html`
3. Make an `.htaccess` file with the following contents:

  ```
  RewriteEngine on
  RewriteRule ^desktop/?(.*) desktop.html [L]
  ```

4. Make a bundle with:

 - the two HTML files you just made
 - .htaccess
 - /contents
 - /thumbs
 - /assets
