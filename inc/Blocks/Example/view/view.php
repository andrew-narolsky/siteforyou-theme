<?php
/** @var array $data */
?>

<section class="wp-block-sfy-example">
    <?php if ($data['image'] ?? null): ?>
        <div
                class="block-example"
                style="background-image: url(<?php echo esc_url(wp_get_attachment_url($data['image'])) ?>)">
        </div>
    <?php endif; ?>

    <div class="example-content">
        <?php if (!empty($data['title'])): ?>
            <h2><?php echo esc_html($data['title']) ?></h2>
        <?php endif; ?>

        <?php if (!empty($data['text'])): ?>
            <p><?php echo esc_html($data['text']) ?></p>
        <?php endif; ?>
    </div>
</section>