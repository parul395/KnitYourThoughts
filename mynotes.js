$(function(){
    //define variables
   var activeNote = 0;
    var editMode = false;
    //load notes on page load: Ajax call to loadnotes.php
    $.ajax({
        url: "loadnotes.php",
        success: function (data){
            $('#notes').html(data);
           clickonNote();
            clickdel();
        },
        error: function(){
            $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
        }
       
    
    });
    
    //add a new note: : Ajax call to createnote.php
    $('#addNote').click(function(){
        
        $.ajax({
            
            
            url: "createnotes.php",
            success: function(data){
                if(data == 'error'){
                   $('#alertContent').text("error creating new page");
                    $('#alert').fadeIn();
                       
                   }
                   else{
                   //update activenote
                       activeNote = data;
                       
                       $("textarea").val = "";
                       //show hide element
                      
                    showHide(["#notePad", "#allNotes"], ["#notes", "#addNote", "#edit", "#done"]);
                    $("textarea").focus();
                      
                   }
            } ,error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
            }
            
        });
        
        
        
    });
    //type note: ajax call to update notes
   $("textarea").keyup(function(){
        //ajax call to update the task of id activenote
        $.ajax({
            url: "updatenotes.php",
            type: "POST",
            //we need to send the current note content with its id to the php file
            data: {note: $(this).val(), id:activeNote},
            success: function (data){
                if(data == 'error'){
                    $('#alertContent').text("There was an issue updating the note in the database!");
                    $("#alert").fadeIn();
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
            }

        });
        
    });
    
    
    
    
    $("#allNotes").click(function(){
      $.ajax({
        url: "loadnotes.php",
        success: function (data){
            $('#notes').html(data);
           showHide(["#addNote","#edit","#notes"],["#notePad","#allNotes"]);
            clickonNote();clickdel();
        },
        error: function(){
            $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
        }
       
    
    });  
        
        
        
        
    });
    
    //click on done after editing
    $("#done").click(function(){
        
        
        editMode = false;
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
        //show hide
        showHide(["#edit"],[this, ".delete"]);
        
    });
    
    //edit mode functionality
    $("#edit").click(function(){
        editMode = true;
        //reduce witdth of notes
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        //show hide elements
        showHide(["#done",".delete"],[this]);
    });
    //click on delete
    function clickdel(){
        $(".delete").click(function(){
            
            var deletebutton = $(this);
            $.ajax({
                url: "deletenote.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:deletebutton.next().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        $('#alertContent').text("There was an issue delete the note from the database!");
                        $("#alert").fadeIn();
                    }else{
                        //remove containing div
                        deletebutton.parent().remove();
                    }
                },
                error: function(){
                    $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                            $("#alert").fadeIn();
                }

            });
        });
    }
    
   function clickonNote(){
        $(".noteheader").click(function(){
        
        if(!editMode){
            activeNote = $(this).attr("id");
            //fill text area
           $("textarea").val($(this).find('.text').text());
            //show hide element
                      
                     showHide(["#notePad", "#allNotes"], ["#notes", "#addNote", "#edit", "#done"]);
                    $("textarea").focus();
            
        }
        
        
        
    });
   }
    
    
   function showHide(array1, array2){
        for(i=0; i<array1.length; i++){
            $(array1[i]).show();   
        }
        for(i=0; i<array2.length; i++){
            $(array2[i]).hide();   
        }
    } 
    
});