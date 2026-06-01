<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета программиста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 Анкета программиста</h1>
            <p>Заполните форму, чтобы стать частью нашего сообщества</p>
        </div>
        
        <div class="form-content">
            <?php
            if (!empty($success_message)) {
                echo $success_message;
            }
            ?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">👤 ФИО <span class="required">*</span></label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           placeholder="Иванов Иван Иванович"
                           value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="phone">📞 Телефон</label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           placeholder="+7 (123) 456-78-90"
                           value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">📧 E-mail</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           placeholder="example@mail.com"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="birthdate">🎂 Дата рождения</label>
                    <input type="date" 
                           id="birthdate" 
                           name="birthdate" 
                           value="<?php echo isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label>⚧ Пол <span class="required">*</span></label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="sex" value="male" 
                                   <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'male') ? 'checked' : ''; ?>>
                            👨 Мужской
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="sex" value="female" 
                                   <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'female') ? 'checked' : ''; ?>>
                            👩 Женский
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>💻 Любимые языки программирования <span class="required">*</span></label>
                    <div class="checkbox-group">
                        <?php
                        $languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
                        $selected_langs = isset($_POST['languages']) ? $_POST['languages'] : [];
                        foreach ($languages as $lang):
                            $checked = in_array($lang, $selected_langs) ? 'checked' : '';
                        ?>
                            <label class="checkbox-label">
                                <input type="checkbox" name="languages[]" value="<?php echo htmlspecialchars($lang); ?>" <?php echo $checked; ?>>
                                <?php echo htmlspecialchars($lang); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="biography">📖 Биография</label>
                    <textarea id="biography" 
                              name="biography" 
                              rows="5" 
                              placeholder="Расскажите немного о себе..."><?php echo isset($_POST['biography']) ? htmlspecialchars($_POST['biography']) : ''; ?></textarea>
                </div>
                
                <div class="contract-group">
                    <label class="contract-label">
                        <input type="checkbox" name="contract" value="1" 
                               <?php echo (isset($_POST['contract']) && $_POST['contract'] == '1') ? 'checked' : ''; ?>>
                        Я ознакомлен(а) с условиями контракта и соглашаюсь с ними <span class="required">*</span>
                    </label>
                </div>
                
                <button type="submit" class="btn-submit">💾 Сохранить анкету</button>
            </form>
        </div>
    </div>
</body>
</html>
