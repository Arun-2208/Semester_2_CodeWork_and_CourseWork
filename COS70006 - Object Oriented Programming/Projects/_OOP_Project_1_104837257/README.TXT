------------------------------------------------------------------------

PROJECT TITLE:
Parking Spot System

PURPOSE OF PROJECT:
The Parking Spot System is a console-based Java application designed to manage the parking slots for a company's car park. 
The system allows users to add and delete parking slots, park and remove cars, and check the status of the parking slots. 
The system is intended to differentiate between staff and visitor parking slots, ensuring that cars are parked in the correct type of slot. 
The project also calculates parking duration and fees for occupied slots. 

VERSION and DATE:
Version 1.0 - 06/09/2024

HOW TO START THIS PROJECT:
1. Open the project in BlueJ.
2. Compile all the classes (`Application`, `Car`, `ParkingSlot`, and `CarPark`).
3. Run the `Application` class to start the program. 
4. Follow the menu prompts in the console to interact with the system.

AUTHOR:
Arun Ragavendhar - 104837257

USER INSTRUCTIONS:
1. **Setting up the Car Park:**
   - The system will first ask you to enter the number of parking slots for staff and visitors.
   - Enter valid positive integers for both staff and visitor slots.

2. **Main Menu Options:**
   - You will be presented with a menu with the following options:
     1. Add a parking slot: Enter the slot ID (e.g., S01 for staff or V01 for visitor) and specify if it is for staff or visitors.
     2. Delete a parking slot: Enter the slot ID to remove, ensuring the slot is unoccupied.
     3. List all slots: Displays all parking slots with details such as slot ID, type, status (occupied or vacant), and car details (if occupied).
     4. Delete all unoccupied parking slots: Removes all slots that are currently unoccupied.
     5. Park a car: Enter a slot ID, car registration number, owner's name, and whether the owner is staff or a visitor.
     6. Find a car by registration number: Enter the registration number to find the parked car's slot and owner details.
     7. Remove a car by registration number: Enter the registration number to remove the car from the corresponding slot.
     8. Exit: Ends the program with a "Program end!" message.

3. **Input Validation:**
   - The system ensures that all inputs follow the required formats:
     - Slot IDs must be an uppercase letter followed by two digits (e.g., S01 for staff or V01 for visitor).
     - Car registration numbers must be an uppercase letter followed by four digits (e.g., T7645).
     - Owner names must only contain alphabetical characters.

4. **Parking Fees:**
   - When a car is parked, the system records the time.
   - If you list the parking slots or find a car, the parking duration and fee will be displayed for occupied slots. 
     The fee is calculated at $5 per hour (rounded up to the nearest hour).

5. **Error Handling:**
   - The system provides clear error messages if invalid inputs are entered or if actions cannot be performed
     (e.g., attempting to park a car in an already occupied slot).

6. **Exiting the Program:**
   - Choose option 8 from the menu to exit the program. 
   Ensure you save any important data, as this console-based system does not retain data after the program ends.


