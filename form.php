<form action="" method="POST">
  <label>ФИО:</label>
  <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required /><br/>
  <label>Телефон:</label>
  <input type="tel" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" /><br/>
  <label>E-mail:</label>
  <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" /><br/>
  <label>Дата рождения:</label>
  <input type="date" name="birthdate" value="<?php echo isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : ''; ?>" /><br/>
  <label>Пол:</label>
  <input type="radio" name="gender" value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : ''; ?> /> Мужской
  <input type="radio" name="gender" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : ''; ?> /> Женский<br/>
  <label>Любимый язык программирования:</label><br/>
  <?php
  $languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
  $selected_langs = isset($_POST['languages']) ? $_POST['languages'] : [];
  foreach ($languages as $lang) {
    $checked = in_array($lang, $selected_langs) ? 'checked' : '';
    echo "<input type='checkbox' name='languages[]' value='" . htmlspecialchars($lang) . "' $checked /> $lang<br/>";
  }
  ?>
  <label>Биография:</label><br/>
  <textarea name="biography" rows="5" cols="40"><?php echo isset($_POST['biography']) ? htmlspecialchars($_POST['biography']) : ''; ?></textarea><br/>
  <label>
    <input type="checkbox" name="contract" value="1" <?php echo (isset($_POST['contract']) && $_POST['contract'] == '1') ? 'checked' : ''; ?> />
    Ознакомлен
  </label><br/>
  
  <input type="submit" value="Сохранить" />
</form>
