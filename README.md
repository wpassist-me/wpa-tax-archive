# WPA Tax Archives

WordPress plugin to display a well structured taxonomy archive for tags, categories or custom taxonomies

Check demo here: https://wpassist.me/tags/

## Usage

- Download latest version from github
- Install the plugin and activate
- Add a page and insert one of the shortcode options below

### Display tags archive

`[taxarchive popular=1 ignore_one=1 taxonomy="post_tag"]`

This shortcode displays tags archive for your posts on WordPress

### Display categories archive

`[taxarchive popular=1 ignore_one=1 taxonomy="category"]` 

This shortcode displays category archives for your posts on WordPress

## Shortcode Options

- `taxonomy` - (default: category) defines taxonomy to use for the archive
- `popular` - (default: false) display most popular taxonomy on top
- `popular_count` - (default: 15) defines number of popular terms to display
- `ignore_one` - (default: false) set to 1 to ignore terms with a single post
- `order` - (default: DESC) terms order for the taxonomy archives
- `orderby` - (default: count) rule to use for ordering the terms

WPA Tax Archive is using get_terms function to get list of terms using the taxonomy. For more information about the function check official page here:

https://developer.wordpress.org/reference/functions/get_terms/

Any ideas? Submit them here: https://github.com/wpassist-me/wpa-tax-archive/issues
