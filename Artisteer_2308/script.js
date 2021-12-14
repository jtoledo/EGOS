/* begin Page */
/* Created by Artisteer v3.1.0.46558 */
// css helper
(function($) {
    var data = [
        {str:navigator.userAgent,sub:'Chrome',ver:'Chrome',name:'chrome'},
        {str:navigator.vendor,sub:'Apple',ver:'Version',name:'safari'},
        {prop:window.opera,ver:'Opera',name:'opera'},
        {str:navigator.userAgent,sub:'Firefox',ver:'Firefox',name:'firefox'},
        {str:navigator.userAgent,sub:'MSIE',ver:'MSIE',name:'ie'}];
    for (var n=0;n<data.length;n++)	{
        if ((data[n].str && (data[n].str.indexOf(data[n].sub) != -1)) || data[n].prop) {
            var v = function(s){var i=s.indexOf(data[n].ver);return (i!=-1)?parseInt(s.substring(i+data[n].ver.length+1)):'';};
            $('html').addClass(data[n].name+' '+data[n].name+v(navigator.userAgent) || v(navigator.appVersion)); break;			
        }
    }
})(jQuery);
/* end Page */

/* begin Layout */
jQuery(function () {
     var c = jQuery('div.art-content');
    if (c.length !== 1) return;
    var s = c.parent().children('.art-layout-cell:not(.art-content)');


    if (jQuery.browser.msie && parseInt(jQuery.browser.version) < 8) {
        jQuery(window).bind('resize', function() {
            var w = 0;
            c.hide();
            s.each(function() { w += this.clientWidth; });
            c.w = c.parent().width(); c.css('width', c.w - w + 'px');
            c.show();
        });
    }

    jQuery(window).trigger('resize');
});/* end Layout */

/* begin VMenu */
jQuery(function() {
    if (!jQuery('html').hasClass('ie7')) return;
    jQuery('ul.art-vmenu li:not(:first-child),ul.art-vmenu li li li:first-child,ul.art-vmenu>li>ul').each(function () { jQuery(this).append('<div class="art-vmenu-separator"> </div><div class="art-vmenu-separator-bg"> </div>'); });
});
jQuery(function() {
    setOpenSubmenuWithHover({vMenuClass: "art-vmenu", activeClass: "active", hoveredClass: "hovered"});
});    

(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover)}})(jQuery);
function setOpenSubmenuWithHover(vMenuInfo) {
    jQuery("ul." + vMenuInfo.vMenuClass + " li").each(function () {
        var item = jQuery(this);
        var simple = item.children("ul").length == 0;
        if (!simple) {
            item.children("a").hoverIntent({interval: 200, over: function() {
                var link = jQuery(this);
                hideVMenuSubmenus(link, vMenuInfo.activeClass);
                showVMenuSubmenu(link, vMenuInfo.activeClass, vMenuInfo.hoveredClass, false);
            }, out: function () { }});
        } 
        item.children("a").bind("click", function(e) {
            var link = jQuery(this);
            hideVMenuSubmenus(link, vMenuInfo.activeClass);
            showVMenuSubmenu(link, vMenuInfo.activeClass, vMenuInfo.hoveredClass, simple);
        });
    });
}
function showVMenuSubmenu(link, activeClass, hoveredClass, simple) {
    if (simple) {
        if (!link.hasClass(activeClass)) link.addClass(activeClass);
        return;
    }
    if (!link.hasClass(activeClass)) {
        link.siblings("ul").slideDown("fast", function() {
            jQuery(this).siblings("a").removeClass(hoveredClass);
            jQuery(this).addClass(activeClass).siblings("a").addClass(activeClass);
            jQuery(this).css("display", "");
        });
    }
}
function hideVMenuSubmenus(link, activeClass) {
    link.parent().siblings().children("ul." + activeClass).slideUp(function() {
        jQuery(this).find("a, ul").removeClass(activeClass);
        jQuery(this).removeClass(activeClass).siblings("a").removeClass(activeClass);
        jQuery(this).css("display", "");
    });
    link.parent().siblings().children("a." + activeClass).removeClass(activeClass);
}

/* end VMenu */

/* begin Button */
function artButtonSetup(className) {
    jQuery.each(jQuery("a." + className + ", button." + className + ", input." + className), function (i, val) {
        var b = jQuery(val);
        if (!b.parent().hasClass('art-button-wrapper')) {
            if (b.is('input')) b.val(b.val().replace(/^\s*/, '')).css('zoom', '1');
            if (!b.hasClass('art-button')) b.addClass('art-button');
            jQuery("<span class='art-button-wrapper'><span class='art-button-l'> </span><span class='art-button-r'> </span></span>").insertBefore(b).append(b);
            if (b.hasClass('active')) b.parent().addClass('active');
        }
        b.mouseover(function () { jQuery(this).parent().addClass("hover"); });
        b.mouseout(function () { var b = jQuery(this); b.parent().removeClass("hover"); if (!b.hasClass('active')) b.parent().removeClass('active'); });
        b.mousedown(function () { var b = jQuery(this); b.parent().removeClass("hover"); if (!b.hasClass('active')) b.parent().addClass('active'); });
        b.mouseup(function () { var b = jQuery(this); if (!b.hasClass('active')) b.parent().removeClass('active'); });
    });
}
jQuery(function() { artButtonSetup("art-button"); });

/* end Button */



