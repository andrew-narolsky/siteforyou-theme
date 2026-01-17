<footer>
    <nav>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer',
            'container' => false,
        ]);
        ?>
    </nav>
</footer>

<?php wp_footer(); ?>
</body>
</html>