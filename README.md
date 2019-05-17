# Fix Upload Dir
Wordpress recently stopped using the UPLOADS constant (which usually lets you control which directory images/media are saved in) on my site, breaking all of my media not manually linked. This was designed as a quick and dirty fix using filters to modify the upload directory manually. 
I've since added  a settings page.

## Features
* Uses the `upload_dir` filter to manually alter attachment URLs to the correct directory
* Directory can be configured via the settings page

## Getting Started

### Installing
* Download the git, and extract the folder to the /wp-content/plugins directory of your wordpress install.
* Activate the plugin in the admin menu
### Configuration
* Plugin settings page now allows you to set the directory from there
* To disable the plugin, deactivate it.

## Authors
**[Cass-E Design]** (https://cass-e.net)

## License
This project is licensed under GPLv2 or later, because it's a wordpress plugin - see the [LICENSE.md] (LICENSE.md) file for details.

## Acknowledgements
I learned how to use the Wordpress Settings API from, among other sources: https://code.tutsplus.com/articles/create-wordpress-plugins-with-oop-techniques--net-20153