
/**
 * This class represents the individual parking slots (visitor or staff)
 * @author Arun Ragavendhar - 104837257
 * @version - 1.0 - 
 */
public class ParkingSlot
{
    // attributes of a Parking Slot 
    private String slotID;
    private boolean isVisitorSlot;
    private Car parkedCar;

    /*Constructor for initialising the attributes of class ParkingSlot*/
    public ParkingSlot(String slotID, boolean isVisitorSlot)
    {
        this.slotID = slotID;
        this.isVisitorSlot = isVisitorSlot;
        this.parkedCar = null;
    }

    /* method to check check if the slot is occupied or not*/
    public boolean isOccupied()
    {
        return this.parkedCar != null;
    }
    
    /* method to add a car*/
    public boolean parkCar(Car car)
    {
        if(this.isOccupied())
            return false;           // slot is already occupied
            
        this.parkedCar = car;
        return true;
        
    }
    
    /* method to remove a car*/    
    public boolean removeCar()
    {
        if(!this.isOccupied())
            return false;         // slot is is already empty
            
        this.parkedCar = null;
            return true;
    }
    
    /* method to return information about a slot*/ 
    public String getSlotInfo()
    {
        String info = "Slot ID : "+ this.slotID + ", Type : "+ (isVisitorSlot?"Visitor":"Staff"); 
        
        if(this.isOccupied())
            info += ", Occupied by : " + this.parkedCar.getRegistrationNumber() + "(Owner : " + this.parkedCar.getOwner() + ")";
        else
            info +=", Unoccupied";
            
        return info;
    }
    
     /* method to get the slot ID*/
     
     public String getSlotID()
     {
         return slotID;
     }
     
     /* method to get the slot type is visitor or staff*/
     
     public String getIsVisitorSlot()
     {
         return slotID;
     }
    
}
