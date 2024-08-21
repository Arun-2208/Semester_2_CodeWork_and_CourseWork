
/**
 * This class has details about the car
 *
 * @author - Arun Ragavendhar - 104837257
 * @version - 1.0 - Project_1
 */
class Car
{
    // attributes of a car
    private String registrationNumber;
    private String owner;
    private boolean isStaff;
    
    /*Constructor to initialise the attributes of class Car*/

    public Car(String registrationNumber, String owner, boolean isStaff)
    {
     this.registrationNumber = registrationNumber; 
     this.owner = owner;
     this.isStaff = isStaff;
    }

    /*method to get the registration number*/
    
    public String getRegistrationNumber()
    {
       return registrationNumber;
    }
    /*method to get the owner*/
    public String getOwner()
    {
        return owner;
    }
    /*method to get the user type is staff or visitor*/
    public boolean isStaff()
    {
        return isStaff;
    }
}
