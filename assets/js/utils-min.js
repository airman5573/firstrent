function validatePhoneNumber(e){return!!/01[016789]-[0-9]{4}-[0-9]{4}/.test(e)}function clearForm(e){e.find("select").each((function(){jQuery(this).prop("selectedIndex",0).trigger("change")})),e.find("textarea").each((function(){return jQuery(this).val("")})),e.find("input:not([type=hidden])").each((function(){switch(this.type){case"password":case"text":return jQuery(this).val("");case"radio":case"checkbox":return void(this.checked=!1)}}))}function post(e,t,n="post"){const c=document.createElement("form");c.method=n,c.action=e;for(const e in t)if(t.hasOwnProperty(e)){const n=document.createElement("input");n.type="hidden",n.name=e,n.value=t[e],c.appendChild(n)}document.body.appendChild(c),c.style.display="none",c.submit()}