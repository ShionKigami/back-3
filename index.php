<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Результаты сохранены');
  }
  include('form.php');
  exit();
}

$errors = FALSE;
$error_messages = [];

if (empty($_POST['name'])) {
  $error_messages[] = 'Заполните ФИО';
  $errors = TRUE;
} elseif (strlen($_POST['name']) > 150) {
  $error_messages[] = 'ФИО не должно превышать 150 символов';
  $errors = TRUE;
} elseif (!preg_match('/^[a-zA-Zа-яА-ЯёЁ\s]+$/u', $_POST['name'])) {
  $error_messages[] = 'ФИО должно содержать только буквы и пробелы';
  $errors = TRUE;
}

if (!empty($_POST['phone']) && !preg_match('/^[\+0-9\s\-\(\)]{10,20}$/', $_POST['phone'])) {
  $error_messages[] = 'Некорректный телефон';
  $errors = TRUE;
}

if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $error_messages[] = 'Некорректный email';
  $errors = TRUE;
}

// Валидация даты рождения
if (!empty($_POST['birthdate'])) {
  $date = DateTime::createFromFormat('Y-m-d', $_POST['birthdate']);
  if (!$date || $date->format('Y-m-d') !== $_POST['birthdate']) {
    $error_messages[] = 'Некорректная дата';
    $errors = TRUE;
  }
}

// Валидация пола
$allowed_genders = ['male', 'female'];
if (empty($_POST['gender'])) {
  $error_messages[] = 'Выберите пол';
  $errors = TRUE;
} elseif (!in_array($_POST['gender'], $allowed_genders)) {
  $error_messages[] = 'Некорректный пол';
  $errors = TRUE;
}

// Валидация любимых языков программирования
$allowed_languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
if (empty($_POST['languages'])) {
  $error_messages[] = 'Выберите хотя бы один язык';
  $errors = TRUE;
} else {
  foreach ($_POST['languages'] as $lang) {
    if (!in_array($lang, $allowed_languages)) {
      $error_messages[] = 'Некорректный язык';
      $errors = TRUE;
      break;
    }
  }
}

if (empty($_POST['contract']) || $_POST['contract'] != '1') {
  $error_messages[] = 'Нужно ознакомиться';
  $errors = TRUE;
}

if ($errors) {
  foreach ($error_messages as $msg) {
    print($msg . '<br/>');
  }
  exit();
}

$user = 'u82197';
$pass = '6410666';
$db = new PDO('mysql:host=localhost;dbname=u82197', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

try {
  $db->beginTransaction();
  
  $stmt = $db->prepare("INSERT INTO users (name, phone, email, birthdate, gender, biography) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->execute([
    $_POST['name'],
    $_POST['phone'] ?? null,
    $_POST['email'] ?? null,
    $_POST['birthdate'] ?? null,
    $_POST['gender'],
    $_POST['biography'] ?? null
  ]);
  
  $user_id = $db->lastInsertId();
  
  $lang_stmt = $db->prepare("INSERT INTO user_languages (user_id, language) VALUES (?, ?)");
  foreach ($_POST['languages'] as $lang) {
    $lang_stmt->execute([$user_id, $lang]);
  }
  
  $db->commit();
  
} catch(PDOException $e){
  $db->rollBack();
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
