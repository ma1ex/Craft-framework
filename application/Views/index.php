<h1><?php echo $page_caption ?></h1>

<ul style="list-style: none; font-size: 1.5rem;">
    <?php foreach($menu as $link => $name): ?>
    <li style="display: inline; margin-right: 5px;">
        <a href="<?php echo $link ?>"><?php echo $name ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<?php foreach($news as $value): ?>
    <div style="margin: 10px; padding: 15px; border: solid 1px gray; border-radius: 10px;">
        <h3><?php echo $value['title'] ?></h3>
        <div><?php echo $value['description_short'] ?></div>
        <p><?php echo $value['description'] ?></p>
    </div>
<?php endforeach; ?>