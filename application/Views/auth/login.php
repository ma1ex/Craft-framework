<h1><?php echo $page_caption ?></h1>

<ul style="list-style: none; font-size: 1.5rem;">
    <?php foreach($menu as $link => $name): ?>
        <li style="display: inline; margin-right: 5px;">
            <a href="<?php echo $link ?>"><?php echo $name ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<form action="">
    <label for="name">Type your name:</label>
    <input type="text" name="name">

    <label for="pass">Type your name:</label>
    <input type="password" name="pass">

    <button type="submit">Login</button>
</form>