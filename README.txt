This site contains files used to create the test program to parse XML data of 
Julius caesar play and display various parameters, such as: Roles, number of lines
spoken by that character, number and percent of scenes in which that role appears
and the longest speech by that role.

These parameters have been created per the requiremnts given.

The data is displayed in a tabular grid, and theuser can cick to view the data
as ascending or descending order, The user can select either 10, 25, 50 or 100 
entries display. Inaddition, they can use the previous/nextt link at the
bottom of the grid to do teh pagination control and display the rest of the data.
As a bonus, we have also provided a search button, typing a text in that selects 
ll records in which the typed search string appears and the the rest ofthe controls
restrict the display to only this set.

Assumptions:

1, It is assumed that the xml data is available in the format shown, I have added 
some additonal code at the begineing and end to faciliate reading frm this file 
and stored it as test1.xml. I can modify the code, if needed, to read directly
what is available in the archive.


Technical details:

First we read the xml file into a string called $xmlstr, using simpleXML method.

Next, we parse this string to make a array containing all the instances of roles
appearing in the play. This will contain multiple instances of the role as it
appears inthe play.

Next, find only unique instances of this array values into a different array.

Next create new array variables based ont he key of the above mentioned 
reference array, initializing the values to either 0 or null as appropriate.

Next parse the original xml string again, stepping through each role. In each case, 
we increment the parameters (numbe of scenes), as well as create the speech.
We track the length of the speech and if larger than the previous longest speech, 
then updtate its value. For each line read, we also add to the number of lines
read by that role.

We do this for all roles at all scenes and acts.

Then we can calculate the percentage of scenes by dividing the number of scenes 
by the total scenes of the play. Both these are tracked and accumulated during 
he previous parsing step.

To display the data, I used an open source package called DataTables. This 
uses jquery and javascript programs to display the data in a data grid.
I used css to prettify the display.

The code is GPL, so others can read and use as appropriate. Enjoy!
