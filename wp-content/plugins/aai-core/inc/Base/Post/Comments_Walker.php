<?php

namespace Element_Ready_Pro\Base\Post;
use Walker_Comment;
use Element_Ready_Pro\Base\Post\Helper\Comments_Render_Html;

class Comments_Walker extends Walker_Comment {
    use Comments_Render_Html;
}