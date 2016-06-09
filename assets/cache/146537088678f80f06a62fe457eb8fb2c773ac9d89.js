
(function()
{if(typeof Array.prototype.indexOf!=='function')
{Array.prototype.indexOf=function(searchElement,fromIndex)
{for(var i=(fromIndex||0),j=this.length;i<j;i+=1)
{if((searchElement===undefined)||(searchElement===null))
{if(this[i]===searchElement)
{return i;}}
else if(this[i]===searchElement)
{return i;}}
return-1;};}})();(function($,undefined)
{var toasting={gettoaster:function()
{var toaster=$('#'+settings.toaster.id);if(toaster.length<1)
{toaster=$(settings.toaster.template).attr('id',settings.toaster.id).css(settings.toaster.css).addClass(settings.toaster['class']);if((settings.stylesheet)&&(!$("link[href="+settings.stylesheet+"]").length))
{$('head').appendTo('<link rel="stylesheet" href="'+settings.stylesheet+'">');}
$(settings.toaster.container).append(toaster);}
return toaster;},notify:function(title,message,priority)
{var $toaster=this.gettoaster();var $toast=$(settings.toast.template.replace('%priority%',priority)).hide().css(settings.toast.css).addClass(settings.toast['class']);$('.title',$toast).css(settings.toast.csst).html(title);$('.message',$toast).css(settings.toast.cssm).html(message);if((settings.debug)&&(window.console))
{console.log(toast);}
$toaster.append(settings.toast.display($toast));if(settings.donotdismiss.indexOf(priority)===-1)
{var timeout=(typeof settings.timeout==='number')?settings.timeout:((typeof settings.timeout==='object')&&(priority in settings.timeout))?settings.timeout[priority]:5000;setTimeout(function()
{settings.toast.remove($toast,function()
{$toast.remove();});},timeout);}}};var defaults={'toaster':{'id':'toaster','container':'body','template':'<div></div>','class':'toaster','css':{'position':'fixed','top':'10px','right':'10px','width':'300px','zIndex':50000}},'toast':{'template':'<div class="alert alert-%priority% alert-dismissible" role="alert">'+'<button type="button" class="close" data-dismiss="alert">'+''+'<span class="sr-only">Close</span>'+'</button>'+'<span class="title"></span>: <span class="message"></span>'+'</div>','css':{},'cssm':{},'csst':{'fontWeight':'bold'},'fade':'slow','display':function($toast)
{return $toast.fadeIn(settings.toast.fade);},'remove':function($toast,callback)
{return $toast.animate({opacity:'0',padding:'0px',margin:'0px',height:'0px'},{duration:settings.toast.fade,complete:callback});}},'debug':false,'timeout':3000,'stylesheet':null,'donotdismiss':[]};var settings={};$.extend(settings,defaults);$.toaster=function(options)
{if(typeof options==='object')
{if('settings'in options)
{settings=$.extend(settings,options.settings);}
var title=('title'in options)?options.title:'Notice';var message=('message'in options)?options.message:null;var priority=('priority'in options)?options.priority:'success';if(message!==null)
{toasting.notify(title,message,priority);}}};$.toaster.reset=function()
{settings={};$.extend(settings,defaults);};})(jQuery);

if(typeof jQuery==="undefined"){throw new Error("multiselect requires jQuery")}(function($){"use strict";var version=$.fn.jquery.split(" ")[0].split(".");if(version[0]<2&&version[1]<7){throw new Error("multiselect requires jQuery version 1.7 or higher")}})(jQuery);(function(factory){if(typeof define==="function"&&define.amd){define(["jquery"],factory)}else{factory(jQuery)}})(function($){"use strict";var Multiselect=function($){function Multiselect($select,settings){var id=$select.prop("id");this.left=$select;this.right=$(settings.right).length?$(settings.right):$("#"+id+"_to");this.actions={leftAll:$(settings.leftAll).length?$(settings.leftAll):$("#"+id+"_leftAll"),rightAll:$(settings.rightAll).length?$(settings.rightAll):$("#"+id+"_rightAll"),leftSelected:$(settings.leftSelected).length?$(settings.leftSelected):$("#"+id+"_leftSelected"),rightSelected:$(settings.rightSelected).length?$(settings.rightSelected):$("#"+id+"_rightSelected"),undo:$(settings.undo).length?$(settings.undo):$("#"+id+"_undo"),redo:$(settings.redo).length?$(settings.redo):$("#"+id+"_redo")};delete settings.leftAll;delete settings.leftSelected;delete settings.right;delete settings.rightAll;delete settings.rightSelected;this.options={keepRenderingSort:settings.keepRenderingSort,submitAllLeft:settings.submitAllLeft!==undefined?settings.submitAllLeft:true,submitAllRight:settings.submitAllRight!==undefined?settings.submitAllLeft:true,search:settings.search};delete settings.keepRenderingSort,settings.submitAllLeft,settings.submitAllRight,settings.search;this.callbacks=settings;this.init()}
Multiselect.prototype={undoStack:[],redoStack:[],init:function(){var self=this;if(self.options.keepRenderingSort){self.skipInitSort=true;self.callbacks.sort=function(a,b){return $(a).data("position")>$(b).data("position")?1:-1};self.left.find("option").each(function(index,option){$(option).data("position",index)});self.right.find("option").each(function(index,option){$(option).data("position",index)})}
if(typeof self.callbacks.startUp=="function"){self.callbacks.startUp(self.left,self.right)}
if(!self.skipInitSort&&typeof self.callbacks.sort=="function"){self.left.find("option").sort(self.callbacks.sort).appendTo(self.left);self.right.each(function(i,select){$(select).find("option").sort(self.callbacks.sort).appendTo(select)})}
if(self.options.search&&self.options.search.left){self.options.search.left=$(self.options.search.left);self.left.before(self.options.search.left)}
if(self.options.search&&self.options.search.right){self.options.search.right=$(self.options.search.right);self.right.before($(self.options.search.right))}
self.events(self.actions)},events:function(actions){var self=this;self.left.on("dblclick","option",function(e){e.preventDefault();self.moveToRight(this,e)});self.right.on("dblclick","option",function(e){e.preventDefault();self.moveToLeft(this,e)});if(self.options.search&&self.options.search.left){self.options.search.left.on("keyup",function(e){var regex=new RegExp(this.value,"ig");self.left.find("option").each(function(i,option){if(option.text.search(regex)>=0){$(option).show()}else{$(option).hide()}})})}
if(self.options.search&&self.options.search.right){self.options.search.right.on("keyup",function(e){var regex=new RegExp(this.value,"ig");self.right.find("option").each(function(i,option){if(option.text.search(regex)>=0){$(option).show()}else{$(option).hide()}})})}
self.right.closest("form").on("submit",function(e){self.left.children().prop("selected",self.options.submitAllLeft);self.right.children().prop("selected",self.options.submitAllRight)});if(navigator.userAgent.match(/MSIE/i)||navigator.userAgent.indexOf("Trident/")>0||navigator.userAgent.indexOf("Edge/")>0){self.left.dblclick(function(e){actions.rightSelected.trigger("click")});self.right.dblclick(function(e){actions.leftSelected.trigger("click")})}
actions.rightSelected.on("click",function(e){e.preventDefault();var options=self.left.find("option:selected");if(options){self.moveToRight(options,e)}
$(this).blur()});actions.leftSelected.on("click",function(e){e.preventDefault();var options=self.right.find("option:selected");if(options){self.moveToLeft(options,e)}
$(this).blur()});actions.rightAll.on("click",function(e){e.preventDefault();var options=self.left.find("option");if(options){self.moveToRight(options,e)}
$(this).blur()});actions.leftAll.on("click",function(e){e.preventDefault();var options=self.right.find("option");if(options){self.moveToLeft(options,e)}
$(this).blur()});actions.undo.on("click",function(e){e.preventDefault();self.undo(e)});actions.redo.on("click",function(e){e.preventDefault();self.redo(e)})},moveToRight:function(options,event,silent,skipStack){var self=this;if(typeof self.callbacks.moveToRight=="function"){return self.callbacks.moveToRight(self,options,event,silent,skipStack)}else{if(typeof self.callbacks.beforeMoveToRight=="function"&&!silent){if(!self.callbacks.beforeMoveToRight(self.left,self.right,options)){return false}}
self.right.append(options);if(!skipStack){self.undoStack.push(["right",options]);self.redoStack=[]}
if(typeof self.callbacks.sort=="function"&&!silent){self.right.find("option").sort(self.callbacks.sort).appendTo(self.right)}
if(typeof self.callbacks.afterMoveToRight=="function"&&!silent){self.callbacks.afterMoveToRight(self.left,self.right,options)}
return self}},moveToLeft:function(options,event,silent,skipStack){var self=this;if(typeof self.callbacks.moveToLeft=="function"){return self.callbacks.moveToLeft(self,options,event,silent,skipStack)}else{if(typeof self.callbacks.beforeMoveToLeft=="function"&&!silent){if(!self.callbacks.beforeMoveToLeft(self.left,self.right,options)){return false}}
self.left.append(options);if(!skipStack){self.undoStack.push(["left",options]);self.redoStack=[]}
if(typeof self.callbacks.sort=="function"&&!silent){self.left.find("option").sort(self.callbacks.sort).appendTo(self.left)}
if(typeof self.callbacks.afterMoveToLeft=="function"&&!silent){self.callbacks.afterMoveToLeft(self.left,self.right,options)}
return self}},undo:function(event){var self=this;var last=self.undoStack.pop();if(last){self.redoStack.push(last);switch(last[0]){case"left":self.moveToRight(last[1],event,false,true);break;case"right":self.moveToLeft(last[1],event,false,true);break}}},redo:function(event){var self=this;var last=self.redoStack.pop();if(last){self.undoStack.push(last);switch(last[0]){case"left":self.moveToLeft(last[1],event,false,true);break;case"right":self.moveToRight(last[1],event,false,true);break}}}};return Multiselect}($);$.multiselect={defaults:{startUp:function($left,$right){$right.find("option").each(function(index,option){$left.find('option[value="'+option.value+'"]').remove()})},beforeMoveToRight:function($left,$right,options){return true},afterMoveToRight:function($left,$right,options){},beforeMoveToLeft:function($left,$right,option){return true},afterMoveToLeft:function($left,$right,option){},sort:function(a,b){if(a.innerHTML=="NA"){return 1}else if(b.innerHTML=="NA"){return-1}
return a.innerHTML>b.innerHTML?1:-1}}};$.fn.multiselect=function(options){return this.each(function(){var $this=$(this),data=$this.data();var settings=$.extend({},$.multiselect.defaults,data,options);return new Multiselect($this,settings)})}});
