$("#ship-to-event-checkbox").click((function(){if($(this).is(":checked"))var e="true",a=$("select#ship_to_event_list").val();else{e="false",a="";$("select#ship_to_event_list").val("Select Event or Warehouse"),$("select#ship_to_event_list").attr("placeholder","Select Event or Warehouse"),$("#shipping_company_field label").text("Company Name"),$("#shipping_company").val(""),$("#shipping_address_1").val(""),$("#shipping_address_2").val(""),$("#shipping_city").val(""),$("#shipping_state").val(""),$("#shipping_postcode").val(""),$("#shipping_company").removeAttr("readonly"),$("#shipping_address_1").removeAttr("readonly"),$("#shipping_address_2").removeAttr("readonly"),$("#shipping_city").removeAttr("readonly"),$("#shipping_state").removeAttr("readonly"),$("#shipping_postcode").removeAttr("readonly")}var t={status:e,event:a,action:"set_event_session",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:t,success:function(e){"false"==e.data.status&&$(document.body).trigger("update_checkout")},fail:function(e){console.log("failure")}})})),$("#ship_to_event_list").change((function(){$(this).attr("id");var e={eventname:$(this).val(),action:"get_event_address",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:e,success:function(e){$("#shipping_company_field label").text("Event/Warehouse"),$("#shipping_company").val(e.data.address.event_name),$("#shipping_address_1").val(e.data.address.street),$("#shipping_city").val(e.data.address.city),$("#shipping_state").val(e.data.address.state),$("#shipping_postcode").val(e.data.address.zip),$("#shipping_company").attr("readonly","readonly"),$("#shipping_address_1").attr("readonly","readonly"),$("#shipping_address_2").attr("readonly","readonly"),$("#shipping_city").attr("readonly","readonly"),$("#shipping_state").attr("readonly","readonly"),$("#shipping_postcode").attr("readonly","readonly"),$(document.body).trigger("update_checkout")},fail:function(e){console.log(e.data.message)}})})),$("#datepicker").change((function(){var e=new Date;e.setDate(e.getDate()+9);var a=new Date($(this).val());checked=e>a?"true":"false";var t={status:checked,action:"set_rush_session",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:t,success:function(e){$(document.body).trigger("update_checkout")},fail:function(e){console.log("failure")}})})),$("#shipping_postcode").change((function(){var e={zip:$(this).val(),action:"check_for_event",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:e,success:function(e){if(e.success){var a="";$.each(e.data.events,(function(e,t){a+='<button type="button" class="list-group-item list-group-item-action" data-toggle="list"><span class="en">'+t.event_name+'</span><br><span class="ea">'+t.street+'</span><br><span class="ec">'+t.city+'</span>, <span class="es">'+t.state+'</span> <span class="ez">'+t.zip+'</span> <span class="badge badge-primary badge-pill"></span></button>'})),$("#events").html(a),$("#eventSelectModal").modal("show")}},fail:function(e){console.log("failure")}})})),$("#ship_to_event").click((function(){var e={status:"true",event:$("#event_name").val(),action:"set_event_session",security:ajax_object.ajax_nonce};$.ajax({type:"POST",url:ajax_object.ajax_url,data:e,success:function(e){$("#eventSelectModal").modal("hide"),$("#shipping_company").val($("#event_name").val()),$("#shipping_address_1").val($("#event_shipping_address_1").val()),$("#shipping_city").val($("#event_shipping_city").val()),$("#shipping_state").val($("#event_shipping_state").val()),$("#shipping_postcode").val($("#event_shipping_postcode").val()),$("#ship_to_event_list").val($("#event_name").val()),$("#ship-to-event-checkbox").prop("checked",!0),$("#ship-to-event").show(),$(document.body).trigger("update_checkout")},fail:function(e){console.log("failure")}})}));