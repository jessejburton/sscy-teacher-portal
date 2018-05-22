/*************************************************
 * 
 *   TEACHERS
 *   classes.js
 *   
 *   Includes all of the javascript code used 
 *   only within the TEACHERS portal
 * 
 *   Version 1.0
 *   by Jesse James Burton
 *   http://www.burtonmediainc.com
 * 
 *************************************************/

/* CLICK HANDLERS */

    // CLICK - class__button--edit
    $(document).on("click", ".class__button--edit", function(){
        // Pass the specific class data to the edit class function
        showModal("../TEACHERS/partials/_edit_class.php");
    });

    // CLICK - class__button--registration
    $(document).on("click", ".class__button--registration", function(){
        // Navigate to the registration for the selected class
        window.location = 'registration.php?show';
    });

    // CLICK - class__button--cancel
    $(document).on("click", ".class__button--registration", function(){
        // Confirm whether or not to cancel the selcted class
        showModal("<p><strong>Are you sure you would like to cancel the following class:</strong></p><p>Monday, April 23rd - Hatha Mixed Levels with John</p>");
    });

    // CLICK - class__button--add
    $(document).on("click", ".class__button--add", function(){
        // Call the add class function
        showModal("<p>Add a class</p>");
    });
    
/* 
*   FUNCTIONS 
*
*   I am using cls as the variable name to represent the 
*   class since 'class' is a reserved word
*
*/

    // Add a new class
    function addClass(){
        // Show the class modal

    }

    // Edit a specific class
    function editClass(cls){
        // Show the class modal and populate it with the passed in class
    }

    // Cancel a specific class
    function cancelClass(cls, message){
        // Cancel the passed in class and add a message to the class
    }

    // Save a class
    function saveClass(cls){
        // Either create a new class if the passed in object ID is 0 or save 
        // the class that is passed in by ID
    }

