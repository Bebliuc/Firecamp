<?php $tab = Green::getAction(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Topolaser - Panou Administrativ</title>
<link href="<?php echo BASE_URL; ?>app/layouts/style.css" id="css_theme" media="screen" rel="Stylesheet" type="text/css">
<?php if($tab == "adauga_produs" OR $tab == "produs") { ?>
<script src="<?php echo BASE_URL; ?>app/layouts/js/mootools-beta-1.2b1.js" type="text/javascript"></script>
<?php } else { ?>
<script src="<?php echo BASE_URL; ?>app/layouts/js/mootools.js" type="text/javascript"></script>
<?php } ?>

<script src="<?php echo BASE_URL; ?>app/layouts/js/sexyalertbox.v1.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>app/layouts/css/sexyalertbox.css" type="text/css" media="all" />
<script type="text/javascript">
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});
window.addEvent('domready', function() {
<?php if (Flash::get('error') !== null): ?>
Sexy.error('<?php echo Flash::get('error'); ?>');
return false;
<?php endif; ?>
<?php if (Flash::get('success') !== null): ?>
Sexy.alert('<?php echo Flash::get('success'); ?>');
return false;
<?php endif; ?>
<?php if (Flash::get('info') !== null): ?>
Sexy.info('<?php echo Flash::get('info'); ?>');
return false;
<?php endif; ?>
});
</script>
<?php if($tab == "adauga_produs" OR $tab == "produs") { ?>
<script src="<?php echo BASE_URL; ?>app/layouts/js/textboxlist.compressed.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
var FacebookList = new Class({
  
  Extends: TextboxList,
  
  options: {    
    onBoxDispose: function(item) { this.autoFeed(item.retrieve('text')); },
    onInputFocus: function() { this.autoShow(); },    
    onInputBlur: function(el) { 
      this.lastinput = el;
      this.blurhide = this.autoHide.delay(200, this);
    },
    autocomplete: {
      'opacity': 0.8,
      'maxresults': 10,
      'minchars': 1
    }
  },
  
  initialize: function(element, autoholder, options) {
    arguments.callee.parent(element, options);
    this.data = [];
		this.autoholder = $(autoholder).set('opacity', this.options.autocomplete.opacity);
		this.autoresults = this.autoholder.getElement('ul');
		var children = this.autoresults.getElements('li');
    children.each(function(el) { this.add(el.innerHTML); }, this); 
  },
  
  autoShow: function(search) {
    this.autoholder.setStyle('display', 'block');
    this.autoholder.getChildren().setStyle('display', 'none');
    if(! search || ! search.trim() || (! search.length || search.length < this.options.autocomplete.minchars)) 
    {
      this.autoholder.getElement('.default').setStyle('display', 'block');
      this.resultsshown = false;
    } else {
      this.resultsshown = true;
      this.autoresults.setStyle('display', 'block').empty();
      this.data.filter(function(str) { return str ? str.test(search, 'i') : false; }).each(function(result, ti) {
        if(ti >= this.options.autocomplete.maxresults) return;
        var that = this;
        var el = new Element('li').addEvents({
          'mouseenter': function() { that.autoFocus(this); },
          'click': function(e) { 
            new Event(e).stop();
            that.autoAdd(this); 
          }
        }).set('html', this.autoHighlight(result, search)).inject(this.autoresults);
        el.store('result', result);
        if(ti == 0) this.autoFocus(el);
      }, this);
    }
    return this;
  },
  
  autoHighlight: function(html, highlight) {
    return html.replace(new RegExp(highlight, 'gi'), function(match) {
      return '<em>' + match + '</em>';
    });
  },
  
  autoHide: function() {    
    this.resultsshown = false;
    this.autoholder.setStyle('display', 'none');    
    return this;
  },
  
  autoFocus: function(el) {
    if(! el) return;
    if(this.autocurrent) this.autocurrent.removeClass('auto-focus');
    this.autocurrent = el.addClass('auto-focus');
    return this;
  },
  
  autoMove: function(direction) {    
    if(!this.resultsshown) return;
    this.autoFocus(this.autocurrent['get' + (direction == 'up' ? 'Previous' : 'Next')]());
    return this;
  },
  
  autoFeed: function(text) {
    this.data.include(text);    
    return this;
  },
  
  autoAdd: function(el) {
    if(!el || ! el.retrieve('result')) return;
    this.add(el.retrieve('result'));
    delete this.data[this.data.indexOf(el.retrieve('result'))];
    this.autoHide();
    var input = this.lastinput || this.current.retrieve('input');
    input.set('value', '').focus();
    return this;
  },
  
  createInput: function(options) {
    var li = arguments.callee.parent(options);
    var input = li.retrieve('input');
    input.addEvents({
      'keydown': function(e) {
        this.dosearch = false;
        switch(new Event(e).code) {
          case Event.Keys.up: return this.autoMove('up');
          case Event.Keys.down: return this.autoMove('down');        
          case Event.Keys.enter: 
            if(! this.autocurrent) break;
            this.autoAdd(this.autocurrent);
            this.autocurrent = false;
            this.autoenter = true;
            break;
          case Event.Keys.esc: 
            this.autoHide();
            if(this.current && this.current.retrieve('input'))
              this.current.retrieve('input').set('value', '');
            break;
          default: this.dosearch = true;
        }
      }.bind(this),
      'keyup': function() {
        if(this.dosearch) this.autoShow(input.value);
      }.bind(this)
    });
    input.addEvent(Browser.Engine.trident ? 'keydown' : 'keypress', function(e) { 
      if(this.autoenter) new Event(e).stop()
      this.autoenter = false;
    }.bind(this));
    return li;
  },
  
  createBox: function(text, options) {
    var li = arguments.callee.parent(text, options);
    return li.addEvents({
      'mouseenter': function() { this.addClass('bit-hover') },
      'mouseleave': function() { this.removeClass('bit-hover') }
    }).adopt(new Element('a', {
      'href': '#',
      'class': 'closebutton',
      'events': {
        'click': function(e) {
          new Event(e).stop();
          if(! this.current) this.focus(this.maininput);
          this.dispose(li);
        }.bind(this)
      }
    })).store('text', text);
  }
  
});


window.addEvent('domready', function() {

var tlist2 = new FacebookList('facebook-demo', 'facebook-auto');

new Request.JSON({'url': '<?php echo get_url('admin/json'); ?>', 'onComplete': function(j) {
j.each(tlist2.autoFeed, tlist2);
}}).send();

$('facebook-form').addEvent('submit',function(){
tlist2.update();
});

});
</script>
<?php } ?>
<?php if($tab == "pagina" OR $tab == "adauga_produs" OR $tab == "produs") { ?>
<script type="text/javascript" src="<?php echo BASE_URL; ?>app/layouts/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "<?php echo BASE_URL; ?>app/layouts/frontend/style.css",
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<?php } ?>
</head>
<body>
<div id="wrap" class="clearfix">
	<div id="header" class="clearfix">
		<span class="left clearfix">
		<h1 id="project_title">Topolaser - Panou administrativ</h1>
		</span>
		<span class="right clearfix">
		Utilizator: <span style="color:#FFFFFF;"><?php echo $_COOKIE['user']; ?></span>
		| <a href="<?php echo get_url('login/logout'); ?>">Logout</a> 
		| <a href="<?php echo get_url(''); ?>">Vezi site</a>
		</span>
	</div>
	<div id="content" class="clearfix">
		<div id="project_navigation" class="clearfix">
			<ul>
				<li<?php if($tab == 'index' OR $tab == "pagina") { echo ' class="current"'; } ?>><a href="<?php echo get_url('admin/index'); ?>"><img alt="Topolaser" class="icon" src="<?php echo BASE_URL; ?>app/layouts/images/dashboard.gif" />Topolaser</a></li>
				<li<?php if($tab == 'produse' OR $tab == 'categorii' OR $tab == 'subcategorii' OR $tab == "adauga_produs" OR $tab == "produs") {echo ' class="current"'; } ?>><a href="<?php echo get_url('admin/produse'); ?>"><img alt="Topolaser" class="icon" src="<?php echo BASE_URL; ?>app/layouts/images/dashboard.gif" />Produse</a></li>
			</ul>
		</div>
		<div id="left" class="clearfix">
			<div id="left_container">
				<div id="action_nav_container">
					<div id="action_nav">
						<ul>
						<?php echo isset($navigation) ? $navigation: ''; ?>
						</ul>
					</div>
				</div>
				<div id="project_list">
					<div id="lolz_activity">
						<div class="project_events">
						<?php echo $content_for_layout; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="right" class="clearfix">
			<div class="hint">
				<h2>Sidebar</h2>
				 Continut
			</div>
		</div>
	</div>
</div>
</body>
</html>