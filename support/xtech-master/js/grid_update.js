/*function updateChild(id, options)
{
    try{
        var myPK = parseInt($.fn.yiiGridView.getSelection(id));
 
        if(isNaN(myPK)){
            return;
        };
 
        var request = $.ajax({ 
          url: "?r=structure/index",
          type: "GET",
          cache: false,
          data: {org_parentID : myPK},
          dataType: "html" 
        });
 
        request.done(function(response) { 
            try{
                if (response.indexOf('<script') == -1){
                    document.getElementById('branch-grid').innerHTML = response;
                }
                else {
                    throw new Error('Invalid Javascript in Response - possible hacking!');
                }
            }
            catch (ex){
                alert(ex.message);
            }
            finally{
                request = null;
            }
        });
 
        request.fail(function(jqXHR, textStatus) {
            try{
                throw new Error('Request failed: ' + textStatus );
            }
            catch (ex){
                alert(ex.message);
            }
            finally{
                request = null;
            }
        });
    }
    catch (ex){
        alert(ex.message);
    }
}*/