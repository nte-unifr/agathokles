set :application, "agathokles"
set :domain,      "nte2"
set :deploy_to,   "/var/www/tests/#{application}"
set :app_path,    "app"

set :repository,  "git@svx-uo1151repo.unifr.ch:nte/agathokles.git"
set :scm,         :git
set :deploy_via,  :rsync_with_remote_cache
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

set :writable_dirs,       ["app/cache", "app/logs"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

set :shared_files,        ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor"]
set :use_composer,        true
set :update_vendors,      true

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL
