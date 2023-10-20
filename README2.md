settings to local db connection
'db' => [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=' . env('PROJECT_NAME') . '-db;dbname=' . env('LOCAL_DB_NAME'),
    'username' => env('LOCAL_USER_LOGIN'),
    'password' => env('LOCAL_USER_PASSWORD'),
    'charset' => 'utf8',
],