/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#response").load('index');
    $("#hello").click(function(){
       $("#response").load('hello'); 
    });
    
});

