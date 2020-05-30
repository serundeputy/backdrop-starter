@setup
  $ssh = getenv('LP_SSH_CMD');
@endsetup

@servers(['web' => $ssh, 'localhost' => '127.0.0.1'])

@task('deploy', ['on' => 'web'])
  cd {{ getenv('LP_PROJECT_ROOT') }}
  @if ($branch)
    git pull origin {{ $branch }}
  @endif
  composer install
  cd {{ getenv('LP_SITE_ROOT') }}
  drush updb -y
  drush bcim -y
  drush cc all
@endtask

@story('pull')
  dump
  getdb
  cleandb
  backupfiles
  getfiles
  cleanfiles
@endstory

@task('dump', ['on' => 'web'])
  mysqldump -u root -p{{ getenv('LP_DB_PWD') }} {{ getenv('LP_DB') }} > {{ getenv('LP_DB_BACK_PATH') }}
  @endtask

@task('getdb', ['on' => 'localhost'])
  scp {{ getenv('LP_SSH_CMD') }}:{{ getenv('LP_DB_BACK_PATH') }} db.sql
@endtask

@task('cleandb', ['on' => 'web'])
  rm {{ getenv('LP_DB_BACK_PATH') }}
@endtask

@task('backupfiles', ['on' => 'web'])
  cd {{ getenv('LP_SITE_ROOT') }}
  tar czf {{ getenv('LP_FILES_BACK_PATH') }} files 
@endtask

@task('getfiles', ['on' => 'localhost'])
  scp {{ getenv('LP_SSH_CMD') }}:{{ getenv('LP_FILES_BACK_PATH') }} /app/f.tgz
@endtask

@task('cleanfiles', ['on' => 'web'])
  rm {{ getenv('LP_FILES_BACK_PATH') }}
@endtask
