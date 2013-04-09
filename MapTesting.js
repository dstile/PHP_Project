/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function returnbox(){
   var thebox =  map.getExtent().transform(toProjection, fromProjection);
   alert("The boundaries of the box are " + thebox);
}
