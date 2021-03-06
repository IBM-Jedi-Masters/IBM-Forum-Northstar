<?php

if (!defined('ABSPATH')) exit;

if (!is_user_logged_in()) {
    echo '<div class="info">'.__('You need to login in order to create posts and topics.', 'asgaros-forum').'&nbsp;<a href="'.wp_login_url(get_permalink()).'">&raquo; '.__('Login', 'asgaros-forum').'</a></div>';
}

?>
<div class="ibm-col-6-4">
<div>
    <div class="pages"><?php echo $this->pageing($this->table_posts); ?></div>
    <div class=""><?php echo $this->forum_menu('thread');?></div>
    <div class="clear"></div>
</div>

<div class="ibm-padding-top-0 ibm-padding-bottom-1 ibm-bold ibm-h4"><?php echo $this->cut_string($this->get_name($this->current_thread, $this->table_threads), 70) . $meClosed; ?></div>
<div class="">
    <?php
    $counter = 0;
    foreach ($posts as $post) {
        $counter++;
        ?>
        <div class="ibm-card ibm-border-blue-50" id="postid-<?php echo $post->id; ?>">
        <div class="ibm-columns">
            <div class="ibm-card__heading ibm-padding-bottom-0">
                <div class="post-date"><a href="<?php echo $this->get_postlink($this->current_thread, $post->id, ($this->current_page + 1)); ?>"><?php echo $this->format_date($post->date); ?></a></div>
                <?php echo $this->post_menu($post->id, $post->author_id, $counter); ?>
                <div class="clear"></div>
            </div>
            <div class="ibm-card__content ibm-padding-top-0">
                <div class="ibm-col-6-1 ibm-padding-bottom-1">
                    <?php echo get_avatar($post->author_id, 60); ?>
                    <br /><strong><?php echo $this->get_username($post->author_id, true); ?></strong><br />
                    <small><?php echo __('Posts:', 'asgaros-forum').'&nbsp;'.$this->count_userposts($post->author_id); ?></small>
                    <?php do_action('asgarosforum_after_post_author', $post->author_id); ?>
                </div>
                <div class="ibm-col-5-2">
                    <?php
                    $post_content = make_clickable(wpautop($wp_embed->autoembed(stripslashes($post->text))));
                    $post_content = apply_filters('asgarosforum_filter_post_content', $post_content);
                    echo $post_content;
                    $this->file_list($post->id, $post->uploads, true);
                    if ($this->options['show_edit_date'] && (strtotime($post->date_edit) > strtotime($post->date))) {
                        echo '<div class="post-edit">'.sprintf(__('Last edited on %s', 'asgaros-forum'), $this->format_date($post->date_edit)).'</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
</div>
</div>
