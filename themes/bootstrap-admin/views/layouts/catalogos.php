<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

<!--     <meta name="description" content="A framework for easily creating beautiful presentations using HTML">
    <meta name="author" content="Hakim El Hattab">
 -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/css/reveal.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/css/theme/starbox.css" id="theme">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/lib/css/zenburn.css">

    <!-- For syntax highlighting -->
    

    <!-- If the query includes 'print-pdf', use the PDF print sheet -->
    <script>
      document.write( '<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/css/print/' + ( window.location.search.match( /print-pdf/gi ) ? 'pdf' : 'paper' ) + '.css" type="text/css" media="print">' );
    </script>

    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/lib/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

   <?php echo $content;?> 

    <script src="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/lib/js/head.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/js/reveal.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/catalogos/js/bootstrap.js"></script>

    <script>

      // Full list of configuration options available here:
      // https://github.com/hakimel/reveal.js#configuration
      Reveal.initialize({
        controls: true,
        progress: true,
        history: true,
        center: true,
        rollingLinks: false,

        theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
        transition: Reveal.getQueryHash().transition || 'page', // default/cube/page/concave/zoom/linear/none

        // Optional libraries used to extend on reveal.js
        dependencies: [
          { src: '<?php echo Yii::app()->theme->baseUrl;?>/catalogos/lib/js/classList.js', condition: function() { return !document.body.classList; } },
          { src: '<?php echo Yii::app()->theme->baseUrl;?>/catalogos/plugin/markdown/showdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
          { src: '<?php echo Yii::app()->theme->baseUrl;?>/catalogos/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
          { src: '<?php echo Yii::app()->theme->baseUrl;?>/catalogos/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
          { src: '<?php echo Yii::app()->theme->baseUrl;?>/catalogos/plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } },
          { src: '<?php echo Yii::app()->theme->baseUrl;?>/catalogos/plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }
          // { src: 'plugin/remotes/remotes.js', async: true, condition: function() { return !!document.body.classList; } }
        ]
      });

    </script>

  </body>
</html>
