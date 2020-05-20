# Elodin Jobs

This plugin requires a Genesis theme to work properly, and it also works best with [Simple Query Shortcodes](https://github.com/jonschr/simple-query-shortcodes), which allows you to easily display job archives within the context of other pages. It does *not* include any WordPress default archives, as that doesn't seem like a particularly useful way to display jobs for most small businesses.

## What's in the box

This plugin does a number of things out of the box:
* Adds a content type for jobs
* Adds categories for jobs
* Sets up the single view of jobs, including three widget areas: sidebar (to show more jobs), above content (to show any required legal statements), after content (for an application form)
* Forces the single 

## Shortcodes

Sample shortcode pulling in all jobs: 

`[loop post_type="jobs" layout="jobs" columns="3"]`

Sample shortcode pulling in a particular category:

`[loop post_type="jobs" layout="jobs" columns="3" taxonomy="job-categories" terms="waco"]`
