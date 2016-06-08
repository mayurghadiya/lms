;(function($){$.fn.eventCalendar=function(options){var calendar=this;if(options.locales&&typeof(options.locales)=='string'){$.getJSON(options.locales,function(data){options.locales=$.extend({},$.fn.eventCalendar.defaults.locales,data);moment.locale(data.locale,options.locales.moment);moment.locale(data.locale);initEventCalendar(calendar,options);}).error(function(){showError("error getting locale json",$(this));});}else{if(options.locales&&options.locales.locale){options.locales=$.extend({},$.fn.eventCalendar.defaults.locales,options.locales);moment.locale(options.locales.locale,options.locales.moment);moment.locale(options.locales.locale);}
initEventCalendar(calendar,options);}};$.fn.eventCalendar.defaults={eventsjson:'<?= $this->config->item('js_path') ?>event_js/events.json.php',eventsLimit:10,locales:{locale:"en",txt_noEvents:"There are no events in this period",txt_SpecificEvents_prev:"",txt_SpecificEvents_after:"events:",txt_next:"next",txt_prev:"prev",txt_NextEvents:"events:",txt_GoToEventUrl:"",txt_loading:"loading..."},showDayAsWeeks:true,startWeekOnMonday:true,showDayNameInCalendar:true,showDescription:false,onlyOneDescription:true,openEventInNewWindow:false,eventsScrollable:false,dateFormat:"D/MM/YYYY",jsonDateFormat:'timestamp',jsonData:"",cacheJson:true};function initEventCalendar(that,options){var eventsOpts=$.extend({},$.fn.eventCalendar.defaults,options);var flags={wrap:"",directionLeftMove:"300",eventsJson:{}};that.each(function(){flags.wrap=$(this);flags.wrap.addClass('eventCalendar-wrap').append("<div class='eventCalendar-details'><div class='eventCalendar-list-wrap'><p class='eventCalendar-subtitle'></p><span class='eventCalendar-loading'>"+eventsOpts.locales.txt_loading+"</span><div class='eventCalendar-list-content'><ul class='eventCalendar-list'></ul></div></div></div>");if(eventsOpts.eventsScrollable){flags.wrap.find('.eventCalendar-list-content').addClass('scrollable');}
setCalendarWidth(flags);$(window).resize(function(){setCalendarWidth(flags);});dateSlider("current",flags,eventsOpts);getEvents(flags,eventsOpts,eventsOpts.eventsLimit,false,false,false,false);changeMonth(flags,eventsOpts);flags.wrap.on('click','.eventCalendar-day a',function(e){e.preventDefault();var year=flags.wrap.attr('data-current-year'),month=flags.wrap.attr('data-current-month'),day=$(this).parent().attr('rel');getEvents(flags,eventsOpts,false,year,month,day,"day");});flags.wrap.on('click','.eventCalendar-monthTitle',function(e){e.preventDefault();var year=flags.wrap.attr('data-current-year'),month=flags.wrap.attr('data-current-month');getEvents(flags,eventsOpts,eventsOpts.eventsLimit,year,month,false,"month");});});flags.wrap.find('.eventCalendar-list').on('click','.eventCalendar-eventTitle',function(e){if(!eventsOpts.showDescription){e.preventDefault();var desc=$(this).parent().find('.eventCalendar-eventDesc');if(!desc.find('a').size()){var eventUrl=$(this).attr('href');var eventTarget=$(this).attr('target');desc.append(''+eventsOpts.locales.txt_GoToEventUrl+'');}
if(desc.is(':visible')){desc.slideUp();}else{if(eventsOpts.onlyOneDescription){flags.wrap.find('.eventCalendar-eventDesc').slideUp();}
desc.slideDown();}}});}
function sortJson(a,b){if(typeof a.date==='string'){return a.date.toLowerCase()>b.date.toLowerCase()?1:-1;}
return a.date>b.date?1:-1;}
function dateSlider(show,flags,eventsOpts){var $eventsCalendarSlider=$("<div class='eventCalendar-slider'></div>"),$eventsCalendarMonthWrap=$("<div class='eventCalendar-monthWrap'></div>"),$eventsCalendarTitle=$("<div class='eventCalendar-currentTitle'><a href='#' class='eventCalendar-monthTitle'></a></div>"),$eventsCalendarArrows=$("<div class='arrow-nav-block'><a href='#' class='eventCalendar-arrow eventCalendar-prev'><span>"+eventsOpts.locales.txt_prev+"</span></a><a href='#' class='eventCalendar-arrow eventCalendar-next'><span>"+eventsOpts.locales.txt_next+"</span></a></div>");$eventsCalendarDaysList=$("<ul class='eventCalendar-daysList'></ul>"),date=new Date();if(!flags.wrap.find('.eventCalendar-slider').length){flags.wrap.prepend($eventsCalendarSlider);$eventsCalendarSlider.append($eventsCalendarMonthWrap);}else{flags.wrap.find('.eventCalendar-slider').append($eventsCalendarMonthWrap);}
flags.wrap.find('.eventCalendar-monthWrap.eventCalendar-currentMonth').removeClass('eventCalendar-currentMonth').addClass('eventCalendar-oldMonth');$eventsCalendarMonthWrap.addClass('eventCalendar-currentMonth').append($eventsCalendarTitle,$eventsCalendarDaysList);if(show==="current"){day=date.getDate();$eventsCalendarSlider.append($eventsCalendarArrows);}else{date=new Date(flags.wrap.attr('data-current-year'),flags.wrap.attr('data-current-month'),1,0,0,0);day=0;moveOfMonth=1;if(show==="prev"){moveOfMonth=-1;}
date.setMonth(date.getMonth()+moveOfMonth);var tmpDate=new Date();if(date.getMonth()===tmpDate.getMonth()){day=tmpDate.getDate();}}
var year=date.getFullYear(),currentYear=new Date().getFullYear(),month=date.getMonth(),monthToShow=month+1;if(show!="current"){getEvents(flags,eventsOpts,eventsOpts.eventsLimit,year,month,false,show);}
flags.wrap.attr('data-current-month',month).attr('data-current-year',year);moment.locale(eventsOpts.locales.locale);var formatedDate=moment(year+" "+monthToShow,"YYYY MM").format("MMMM YYYY");$eventsCalendarTitle.find('.eventCalendar-monthTitle').html(formatedDate);var daysOnTheMonth=32-new Date(year,month,32).getDate();var daysList=[],i;if(eventsOpts.showDayAsWeeks){$eventsCalendarDaysList.addClass('eventCalendar-showAsWeek');if(eventsOpts.showDayNameInCalendar){$eventsCalendarDaysList.addClass('eventCalendar-showDayNames');i=0;if(eventsOpts.startWeekOnMonday){i=1;}
for(;i<7;i++){daysList.push('<li class="eventCalendar-day-header">'+moment()._locale._weekdaysShort[i]+'</li>');if(i===6&&eventsOpts.startWeekOnMonday){daysList.push('<li class="eventCalendar-day-header">'+moment()._locale._weekdaysShort[0]+'</li>');}}}
dt=new Date(year,month,01);var weekDay=dt.getDay();if(eventsOpts.startWeekOnMonday){weekDay=dt.getDay()-1;}
if(weekDay<0){weekDay=6;}
for(i=weekDay;i>0;i--){daysList.push('<li class="eventCalendar-day eventCalendar-empty"></li>');}}
for(dayCount=1;dayCount<=daysOnTheMonth;dayCount++){var dayClass="";if(day>0&&dayCount===day&&year===currentYear){dayClass="today";}
daysList.push('<li id="dayList_'+dayCount+'" rel="'+dayCount+'" class="eventCalendar-day '+dayClass+'"><a href="#">'+dayCount+'</a></li>');}
$eventsCalendarDaysList.append(daysList.join(''));$eventsCalendarSlider.css('height',$eventsCalendarMonthWrap.height()+'px');}
function getEvents(flags,eventsOpts,limit,year,month,day,direction){limit=limit||0;year=year||'';day=day||'';if(typeof month!='undefined'){month=month;}else{month='';}
flags.wrap.find('.eventCalendar-loading').fadeIn();if(eventsOpts.jsonData){eventsOpts.cacheJson=true;flags.eventsJson=eventsOpts.jsonData;getEventsData(flags,eventsOpts,flags.eventsJson,limit,year,month,day,direction);}else if(!eventsOpts.cacheJson||!direction){$.getJSON(eventsOpts.eventsjson+"?limit="+limit+"&year="+year+"&month="+month+"&day="+day,function(data){flags.eventsJson=data;getEventsData(flags,eventsOpts,flags.eventsJson,limit,year,month,day,direction);}).error(function(){showError("error getting json: ",flags.wrap);});}else{getEventsData(flags,eventsOpts,flags.eventsJson,limit,year,month,day,direction);}
if(day>''){flags.wrap.find('.eventCalendar-current').removeClass('eventCalendar-current');flags.wrap.find('#dayList_'+day).addClass('eventCalendar-current');}}
function getEventsData(flags,eventsOpts,data,limit,year,month,day,direction){directionLeftMove="-="+flags.directionLeftMove;eventContentHeight="auto";subtitle=flags.wrap.find('.eventCalendar-list-wrap .eventCalendar-subtitle');if(!direction){subtitle.html(eventsOpts.locales.txt_NextEvents);eventContentHeight="auto";directionLeftMove="-=0";}else{var jsMonth=parseInt(month)+1,formatedDate;moment.locale(eventsOpts.locales.locale);if(day!==''){formatedDate=moment(year+" "+jsMonth+" "+day,"YYYY MM DD").format("LL");subtitle.html(eventsOpts.locales.txt_SpecificEvents_prev+formatedDate+" "+eventsOpts.locales.txt_SpecificEvents_after);}else{formatedDate=moment(year+" "+jsMonth,"YYYY MM").format("MMMM");subtitle.html(eventsOpts.locales.txt_SpecificEvents_prev+formatedDate+" "+eventsOpts.locales.txt_SpecificEvents_after);}
if(direction==='eventCalendar-prev'){directionLeftMove="+="+flags.directionLeftMove;}else if(direction==='day'||direction==='month'){directionLeftMove="+=0";eventContentHeight=0;}}
flags.wrap.find('.eventCalendar-list').animate({opacity:eventsOpts.moveOpacity,left:directionLeftMove,height:eventContentHeight},eventsOpts.moveSpeed,function(){flags.wrap.find('.eventCalendar-list').css({'left':0,'height':'auto'}).hide();var events=[];data=$(data).sort(sortJson);if(data.length){var eventDescClass='';if(!eventsOpts.showDescription){eventDescClass='eventCalendar-hidden';}
var eventLinkTarget="_self";if(eventsOpts.openEventInNewWindow){eventLinkTarget='_target';}
var i=0;$.each(data,function(key,event){var eventDateTime,eventDate,eventTime,eventYear,eventMonth,eventDay,eventMonthToShow,eventHour,eventMinute,eventSeconds;if(eventsOpts.jsonDateFormat=='human'){eventDateTime=event.date.split(" ");eventDate=eventDateTime[0].split("-");eventTime=eventDateTime[1].split(":");eventYear=eventDate[0];eventMonth=parseInt(eventDate[1])-1;eventDay=parseInt(eventDate[2]);eventMonthToShow=parseInt(eventMonth)+1;eventHour=eventTime[0];eventMinute=eventTime[1];eventSeconds=eventTime[2];eventDate=new Date(eventYear,eventMonth,eventDay,eventHour,eventMinute,eventSeconds);}else{eventDate=new Date(parseInt(event.date));eventYear=eventDate.getFullYear();eventMonth=eventDate.getMonth();eventDay=eventDate.getDate();eventMonthToShow=eventMonth+1;eventHour=eventDate.getHours();eventMinute=eventDate.getMinutes();}
if(parseInt(eventMinute)<=9){eventMinute="0"+parseInt(eventMinute);}
if(limit===0||limit>i){if((month===false||month==eventMonth)&&(day===''||day==eventDay)&&(year===''||year==eventYear)){if(month===false&&eventDate<new Date()){}else{moment.locale(eventsOpts.locales.locale);eventStringDate=moment(eventDate).format(eventsOpts.dateFormat);var eventTitle;if(event.url){eventTitle='<a href="'+event.url+'" target="'+eventLinkTarget+'" class="eventCalendar-eventTitle">Title: '+event.title+'</a>';}else{eventTitle='<div class="eventCalendar-eventTitle"><i class="fa fa-check-square-o" aria-hidden="true"></i><b>Title :</b><span>'+event.title+'<span></div>'+'<div class="eventCalendar-eventDesc eventCalendar-hidden"><p><i class="fa fa-file-text-o" aria-hidden="true"></i><b>Description :</b><span>'+event.description+'</span></p><p><i class="fa fa-calendar-o" aria-hidden="true"></i><b>Time :</b><span>'+event.event_start_time+'</span></p><p><i class="fa fa-map-marker" aria-hidden="true"></i><b>Location :</b><span>'+event.Location+'</span></p><p><i class="fa fa-coffee" aria-hidden="true"></i><b>Intention :</b><span>'+event.description+'</span></p></div>';}
events.push('<li id="'+key+'" class="'+event.type+'"><time class="time_det" datetime="'+eventDate+'"><i class="mar4top fa fa-calendar-o" aria-hidden="true"></i><b>Date :</b><span><em>'+eventStringDate+'</em></span></time>'+eventTitle+'<p class="eventCalendar-eventDesc displaynone '+eventDescClass+'">'+event.description+'</p></li>');i++;}}}
if(eventYear==flags.wrap.attr('data-current-year')&&eventMonth==flags.wrap.attr('data-current-month')){flags.wrap.find('.eventCalendar-currentMonth .eventCalendar-daysList #dayList_'+parseInt(eventDay)).addClass('eventCalendar-dayWithEvents');}});}
if(!events.length){events.push('<li class="eventCalendar-noEvents"><p>'+eventsOpts.locales.txt_noEvents+'</p></li>');}
flags.wrap.find('.eventCalendar-loading').hide();flags.wrap.find('.eventCalendar-list').html(events.join(''));flags.wrap.find('.eventCalendar-list').animate({opacity:1,height:"toggle"},eventsOpts.moveSpeed);});setCalendarWidth(flags);}
function changeMonth(flags,eventsOpts){flags.wrap.find('.eventCalendar-arrow').click(function(e){e.preventDefault();var lastMonthMove;if($(this).hasClass('eventCalendar-next')){dateSlider("next",flags,eventsOpts);lastMonthMove='-='+flags.directionLeftMove;}else{dateSlider("prev",flags,eventsOpts);lastMonthMove='+='+flags.directionLeftMove;}
flags.wrap.find('.eventCalendar-monthWrap.eventCalendar-oldMonth').animate({opacity:eventsOpts.moveOpacity,left:lastMonthMove},0,function(){flags.wrap.find('.eventCalendar-monthWrap.eventCalendar-oldMonth').remove();});});}
function showError(msg,wrap){wrap.find('.eventCalendar-list-wrap').html("<span class='eventCalendar-loading eventCalendar-error'>"+msg+"</span>");}
function setCalendarWidth(flags){flags.directionLeftMove=flags.wrap.width();flags.wrap.find('.eventCalendar-monthWrap').width(flags.wrap.width()+'px');}})(jQuery);
