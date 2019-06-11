function wpacuTabOpenSettingsArea(a,b){a.preventDefault();var c,d,e;for(d=document.getElementsByClassName("wpacu-settings-tab-content"),c=0;c<d.length;c++)d[c].style.display="none";for(e=document.getElementsByClassName("wpacu-settings-tab-link"),c=0;c<e.length;c++)e[c].className=e[c].className.replace(" active","");document.getElementById(b).style.display="table-cell",jQuery('a[href="#'+b+'"]').addClass("active"),jQuery("#wpacu-selected-tab-area").val(b)}if(jQuery(document).ready(function(a){function b(){if(!a("#wpacu_ajax_fetch_assets_list_dashboard_view").length)return!1;var b={};"direct"===wpacu_object.dom_get_type?(b[wpacu_object.plugin_name+"_load"]=1,b[wpacu_object.plugin_name+"_time_r"]=(new Date).getTime(),a.ajax({method:"GET",url:wpacu_object.page_url,data:b,cache:!1,complete:function(b,c){if("error"===b.statusText){var d=wpacu_object.ajax_direct_fetch_error;d=d.replace(/\{wpacu_output\}/,b.responseText),d=d.replace(/\{wpacu_status_code_error\}/,b.status),a("#wpacu_meta_box_content").html(d)}}}).done(function(b){var c=b.substring(b.lastIndexOf(wpacu_object.start_del)+wpacu_object.start_del.length,b.lastIndexOf(wpacu_object.end_del)),d={action:wpacu_object.plugin_name+"_get_loaded_assets",wpacu_list:c,post_id:wpacu_object.post_id,page_url:wpacu_object.page_url,tag_id:wpacu_object.tag_id,time_r:(new Date).getTime()};a.post(wpacu_object.ajax_url,d,function(b){if(!b)return!1;a("#wpacu_meta_box_content").html(b),a("#wpacu_home_page_form").length>0&&a("#submit").show(),setTimeout(function(){e.load(),a(".wpacu_asset_row").removeClass("wpacu-loading"),a("#wpacu-assets-reloading").remove()},200)})})):"wp_remote_post"===wpacu_object.dom_get_type&&(b={action:wpacu_object.plugin_name+"_get_loaded_assets",post_id:wpacu_object.post_id,page_url:wpacu_object.page_url,tag_id:wpacu_object.tag_id,time_r:(new Date).getTime()},a.post(wpacu_object.ajax_url,b,function(b){if(!b)return!1;a("#wpacu_meta_box_content").html(b),a("#wpacu_home_page_form").length>0&&a("#submit").show(),setTimeout(function(){e.load()},200)}))}a("#wpacu-mark-license-valid-button").click(function(){return confirm(wpacu_object.mark_license_valid_confirm)});var c,d;a("#wpacu-reset-drop-down").on("change keyup keydown mouseup mousedown click",function(){""===a(this).val()?(a("#wpacu-warning-read").removeClass("wpacu-visible"),a("#wpacu-reset-submit-btn").attr("disabled","disabled").removeClass("button-primary").addClass("button-secondary")):("reset_everything"===a(this).val()?a("#wpacu-license-data-remove-area").addClass("wpacu-visible"):a("#wpacu-license-data-remove-area").removeClass("wpacu-visible"),a("#wpacu-warning-read").addClass("wpacu-visible"),a("#wpacu-reset-submit-btn").removeAttr("disabled").removeClass("button-secondary").addClass("button-primary")),a(".wpacu-tools-area .wpacu-warning").hide(),c=a(this).find("option:selected"),a("#"+c.attr("data-id")).show()}),a("#wpacu-reset-submit-btn").on("click",function(){if("reset_settings"===a("#wpacu-reset-drop-down").val()?d=wpacu_object.reset_settings_confirm_msg:"reset_everything_except_settings"===a("#wpacu-reset-drop-down").val()?d=wpacu_object.reset_everything_except_settings_confirm_msg:"reset_everything"===a("#wpacu-reset-drop-down").val()&&(d=wpacu_object.reset_everything_confirm_msg),!confirm(d))return!1;a("#wpacu-action-confirmed").val("yes"),setTimeout(function(){"yes"===a("#wpacu-action-confirmed").val()&&a("#wpacu-tools-form").submit()},1e3)}),a("#wpacu-import-form").submit(function(){if(!confirm(wpacu_object.import_confirm_msg))return!1;a(this).find("button").addClass("wpacu-importing").prop("disabled",!0)});var e={load:function(){var b;a(".input-unload-on-this-page").on("click change",function(){a(this).prop("checked")?a(this).closest("tr").addClass("wpacu_not_load"):a(this).closest("tr").removeClass("wpacu_not_load")}),a(".wpacu-plugin-check-all").on("click",function(b){b.preventDefault();var c=a(this).attr("data-wpacu-plugin");a('table.wpacu_list_by_location[data-wpacu-plugin="'+c+'"]').find(".input-unload-on-this-page.wpacu-not-locked").prop("checked",!0).closest("tr").addClass("wpacu_not_load")}),a(".wpacu-plugin-uncheck-all").on("click",function(b){b.preventDefault();var c=a(this).attr("data-wpacu-plugin");a('table.wpacu_list_by_location[data-wpacu-plugin="'+c+'"]').find(".input-unload-on-this-page.wpacu-not-locked").prop("checked",!1).closest("tr").removeClass("wpacu_not_load")}),a(".wpacu_global_unload").click(function(){b=a(this).attr("data-handle"),a(this).prop("checked")?a(this).parent("label").addClass("wpacu_global_checked"):a(this).parent("label").removeClass("wpacu_global_checked")}),a(".wpacu_keep_bulk_rule").click(function(){a(this).prop("checked")&&a(this).parents("li").next().removeClass("remove_rule")}),a(".wpacu_remove_bulk_rule").click(function(){a(this).prop("checked")&&a(this).parents("li").addClass("remove_rule")}),a(".wpacu_bulk_unload").click(function(){a(this).prop("checked")?a(this).parent("label").addClass("wpacu_bulk_unload_active"):a(this).parent("label").removeClass("wpacu_bulk_unload_active")}),a(".wpacu_load_it_option").click(function(){var b=a(this).attr("data-handle");if(a(this).prop("checked")){a(this).parent("label").addClass("wpacu_global_unload_exception");var c="";a(this).hasClass("wpacu_style")?c="style":a(this).hasClass("wpacu_script")&&(c="script"),a("#"+c+"_"+b).prop("checked",!1).trigger("change")}else a(this).parent("label").removeClass("wpacu_global_unload_exception")}),a(".wpacu-add-handle-note").on("click",function(b){b.preventDefault();var c=a(this).attr("data-handle"),d=a('.wpacu-handle-notes-field[data-handle="'+c+'"]');d.is(":hidden")?a(d).show():a(d).hide()}),a(".wpacu-external-file-size").on("click",function(b){b.preventDefault();var c,d=a(this);d.hide(),c=d.next(),c.show(),a.post(wpacu_object.ajax_url,{action:"get_external_file_size",wpacu_remote_file:d.attr("data-src")},function(a){c.html(a)})})}};a(".wpacu-dom-get-type-selection").change(function(){a(this).is(":checked")&&(a(".wpacu-dom-get-type-info").hide(),a("#"+a(this).attr("data-target")).fadeIn("fast"))}),a("#wpacu_post_type_select").change(function(){a("#wpacu_post_type_form").submit()}),a("#wpacu_taxonomy_select").change(function(){a("#wpacu_taxonomy_form").submit()}),a("#wpacu_dashboard").click(function(){a(this).prop("checked")?a("#wpacu-settings-assets-retrieval-mode").fadeIn("fast"):a("#wpacu-settings-assets-retrieval-mode").fadeOut("fast")}),a("#wpacu_frontend").click(function(){a(this).prop("checked")?a("#wpacu-settings-frontend-exceptions").fadeIn("fast"):a("#wpacu-settings-frontend-exceptions").fadeOut("fast")}),a("#wpacu_assets_list_layout").on("click change",function(){"by-location"===a(this).val()?a("#wpacu-assets-list-by-location-selected").fadeIn("fast"):a("#wpacu-assets-list-by-location-selected").fadeOut("fast")}),a("#wpacu_disable_jquery_migrate").on("click",function(){return!a(this).is(":checked")||(!(!a(this).is(":checked")||!confirm(wpacu_object.jquery_migration_disable_confirm_msg))||(a(this).prop("checked",!1),!1))}),a("#wpacu_disable_comment_reply").on("click",function(){return!a(this).is(":checked")||(!(!a(this).is(":checked")||!confirm(wpacu_object.comment_reply_disable_confirm_msg))||(a(this).prop("checked",!1),!1))}),a("#wpacu_combine_loaded_css_enable").click(function(){a(this).prop("checked")?a("#combine_loaded_css_info_area").css({opacity:1}):a("#combine_loaded_css_info_area").css({opacity:.4})}),a("#wpacu_combine_loaded_js_enable").click(function(){a(this).prop("checked")?a("#combine_loaded_js_info_area").css({opacity:1}):a("#combine_loaded_js_info_area").css({opacity:.4})}),a("#wpacu_minify_css_enable").click(function(){a(this).prop("checked")?a("#wpacu_minify_css_exceptions_area").css({opacity:1}):a("#wpacu_minify_css_exceptions_area").css({opacity:.4})}),a("#wpacu_minify_js_enable").click(function(){a(this).prop("checked")?a("#wpacu_minify_js_exceptions_area").css({opacity:1}):a("#wpacu_minify_js_exceptions_area").css({opacity:.4})}),a("#wpacu_remove_html_comments").click(function(){a(this).prop("checked")?a("#wpacu_remove_html_comments_area").css({opacity:1}):a("#wpacu_remove_html_comments_area").css({opacity:.4})}),a(".wpacu-combine-loaded-js-level").change(function(){a(this).is(":checked")&&(a(".wpacu_combine_loaded_js_level_area").removeClass("wpacu_active"),a("#"+a(this).attr("data-target")).addClass("wpacu_active"))});var f=a('#wpacu-update-button-area input[type="submit"]');f.click(function(){a("#wpacu-updating-settings").show()});var g=a("#wpacu-update-front-settings-area .wpacu_update_btn");if(g.parents("form").submit(function(){return g.attr("disabled",!0).addClass("wpacu_submitting"),a("#wpacu-updating-front-settings").show(),!0}),a("form#wpacu-settings-form, form#wpacu_home_page_form").submit(function(){return f.attr("disabled",!0),!0}),a(".wpacu_remove_rule").click(function(){var b=a(this).parents(".wpacu_global_rule_row");a(this).prop("checked")?b.addClass("selected"):b.removeClass("selected")}),a(".wpacu_restore_position").click(function(){var b=a(this).parents(".wpacu_restore_position_row");a(this).prop("checked")?b.addClass("wpacu_selected"):b.removeClass("wpacu_selected")}),a(".wpacu_remove_global_attr").click(function(){var b=a(this).parents(".wpacu_remove_global_attr_row");a(this).prop("checked")?b.addClass("wpacu_selected"):b.removeClass("wpacu_selected")}),a("#wpacu_wrap_assets").length>0&&setTimeout(function(){e.load()},200),"undefined"==typeof wpacu_object||a("#wpacu_meta_box_content").length<1)return!1;b(),a(document).on("click",".wp-admin.post-php .edit-post-header__settings button.is-primary",function(){var c=function(){if(0===a(".edit-post-header__settings .is-saving").length){if(a("#wpacu_unload_assets_area_loaded").length>0&&a("#wpacu_unload_assets_area_loaded").val()){a("#wpacu-assets-reloading").remove();var c='<span id="wpacu-assets-reloading" class="editor-post-saved-state is-wpacu-reloading">'+wpacu_object.reload_icon+wpacu_object.reload_msg+"</span>";a(".wp-admin.post-php .edit-post-header__settings").prepend(c)}a(".wpacu_asset_row").addClass("wpacu-loading"),b(),clearInterval(d)}},d=setInterval(c,900)})}),-1!==location.href.indexOf("#")){var hashFromUrl=location.href.substr(location.href.indexOf("#"));jQuery('a[href="'+hashFromUrl+'"]').trigger("click")};