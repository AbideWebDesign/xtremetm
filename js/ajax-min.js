function populateStates(){var a={Data:{Alabama:"AL",Alaska:"AK",Arizona:"AZ",Arkansas:"AR",California:"CA",Colorado:"CO",Connecticutt:"CT",Delaware:"DE",Florida:"FL",Georgia:"GA",Hawaii:"HI",Idaho:"ID",Illinois:"IL",Indiana:"IN",Iowa:"IA",Kansas:"KS",Kentucky:"KY",Louisiana:"LA",Maine:"ME",Massachusetts:"MA",Michigan:"MI",Minnesota:"MN",Mississippi:"MS",Missouri:"MO",Montana:"MT",Nebraska:"NE",Nevada:"NV","New Hampshire":"NH","New Jersey":"NJ","New Mexico":"NM","New York":"NY","North Carolina":"NC","North Dakota":"ND",Ohio:"OH",Oklahoma:"OK",Oregon:"OR",Pennsylvania:"PA","Rhode Island":"RI","South Carolina":"SC","South Dakota":"SD",Tennessee:"TN",Texas:"TX",Utah:"UT",Vermont:"VT",Virginia:"VA",Washington:"WA","West Virginia":"WV",Wisconsin:"WI",Wyoming:"WY","Virgin Islands":"V.I.",Guam:"GU","Puerto Rico":"PR",Ontario:"ON"}},e=document.getElementById("shipping_state"),t=0;for(var s in a.Data)e.options[t++]=new Option(s,a.Data[s],!0,!1)}$("#ship-to-event-checkbox").click((function(){if($(this).is(":checked")){var a="true",e=$("select#ship_to_event_list").val();$("#datepicker").val("")}else{a="false",e="";$("#ship_to_event_list").val(0),$("#ship_to_event_list").attr("placeholder","Select Event or Warehouse"),$("#shipping_company_field label").text("Company Name"),$("#shipping_company").val(""),$("#shipping_address_1").val(""),$("#shipping_address_2").val(""),$("#shipping_city").val(""),$("#shipping_state").val(""),$("#shipping_postcode").val(""),$("#shipping_company").removeAttr("readonly"),$("#shipping_address_1").removeAttr("readonly"),$("#shipping_address_2").removeAttr("readonly"),$("#shipping_city").removeAttr("readonly"),$("#shipping_state").removeAttr("readonly"),populateStates(),$("#shipping_postcode").removeAttr("readonly"),$("#datepicker").val("")}var t={status:a,event:e,action:"set_event_session",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:t,success:function(a){"false"==a.data.status&&$(document.body).trigger("update_checkout")},fail:function(a){console.log("failure")}})})),$("#ship_to_event_list").change((function(){$(this).attr("id");var a={eventname:$(this).val(),action:"get_event_address",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:a,success:function(a){var e=$("#shipping_state"),t=$('#shipping_state option[value="'+a.data.address.state+'"]');$('#shipping_state option[value!="'+a.data.address.state+'"]').remove(),0!=t.length?t.attr("selected",!0):e.append($("<option>",{value:a.data.address.state,text:a.data.address.state_name})),$("#shipping_company_field label").text("Event/Warehouse"),$("#shipping_company").val(a.data.address.event_name),$("#shipping_address_1").val(a.data.address.street),$("#shipping_city").val(a.data.address.city),$("#shipping_postcode").val(a.data.address.zip),$("#shipping_company").attr("readonly","readonly"),$("#shipping_address_1").attr("readonly","readonly"),$("#shipping_address_2").attr("readonly","readonly"),$("#shipping_city").attr("readonly","readonly"),$("#shipping_state").attr("readonly","readonly"),$("#shipping_postcode").attr("readonly","readonly"),$(document.body).trigger("update_checkout")},fail:function(a){console.log(a.data.message)}})})),$("#shipping_postcode").change((function(){var a={zip:$(this).val(),action:"check_for_event",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:a,success:function(a){if(a.success){var e="";$.each(a.data.events,(function(a,t){e+='<button type="button" class="list-group-item list-group-item-action" data-toggle="list"><span class="en">'+t.event_name+'</span><br><span class="ea">'+t.street+'</span><br><span class="ec">'+t.city+'</span>, <span class="es">'+t.state+'</span> <span class="ez">'+t.zip+'</span> <span class="badge badge-primary badge-pill"></span></button>'})),$("#events").html(e),$("#eventSelectModal").modal("show")}},fail:function(a){console.log("failure")}})})),$("#ship_to_event").click((function(){var a={status:"true",event:$("#event_name").val(),action:"set_event_session",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:a,success:function(a){$("#eventSelectModal").modal("hide"),$("#shipping_company").val($("#event_name").val()),$("#shipping_address_1").val($("#event_shipping_address_1").val()),$("#shipping_city").val($("#event_shipping_city").val()),$("#shipping_state").val($("#event_shipping_state").val()),$("#shipping_postcode").val($("#event_shipping_postcode").val()),$("#ship_to_event_list").val($("#event_name").val()),$("#ship-to-event-checkbox").prop("checked",!0),$("#ship-to-event").show(),$(document.body).trigger("update_checkout")},fail:function(a){console.log("failure")}})}));