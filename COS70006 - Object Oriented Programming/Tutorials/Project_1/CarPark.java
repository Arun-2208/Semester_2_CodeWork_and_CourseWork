
import java.util.ArrayList;
import java.util.List;
/**
 * This CarPark class manages the list of Parking slots
 * @author - Arun Ragavendhar - 104837257
 * @version - 1.0
 */
public class CarPark
{
    // List of parking slots
    List<ParkingSlot> slots;

    /* Constructor for initialising the List of slots*/
    public CarPark()
    {
        this.slots = new ArrayList<>();
    }

    /* method to add a new slot to the car park*/
    public boolean addSlot(ParkingSlot slot)
    {
        for(ParkingSlot s : slots)
        {
            if(s.getSlotID().equals(slot.getSlotID()))
                return false;            // slot ID already exists
        }
        
        slots.add(slot);
        return true;
        }
        
    /* method to remove a slot by by ID*/
    public boolean removeSlot(String slotID)
    {
       for(ParkingSlot slot : slots)
       {
         if(slot.getSlotID().equals(slotID) && !slot.isOccupied())
         {
            slots.remove(slot);
            return true;
         }
       }
            return false;         // slot does not exist or is occupied
    }
  
    /* method to list all slots*/
    public void listSlots()
    {
        for(ParkingSlot slot : slots)
        {
            System.out.println(slot.getSlotInfo());
        }
    }
    
    /* method to find a slot by car registration number*/
    public ParkingSlot findSlotByCar(String registrationNumber)
    {
      for(ParkingSlot slot : slots)
      {
          if(slot.isOccupied() && slot.getSlotInfo().contains(registrationNumber))
              return slot;  
      }
      
      return null;             // slot is occupied or the registration number does not exist
    }
    
    /* method to park a car in a specific slot*/
    public boolean parkCar(String slotID , Car car)
    {
        for(ParkingSlot slot : slots)
        {
            if(slot.getSlotID().equals(slotID) && !slot.isOccupied())
            {
                slot.parkCar(car);
                return true;
            }
        }
        
        return false;
    }
    
    /* method to remove a car by its registration number*/
    public boolean removeCar(String registrationNumber)
    {
        ParkingSlot slot  = findSlotByCar(registrationNumber);
        
        if(slot != null)
        {
            slot.removeCar();
            return true;
        }
        
        return false;
    }
}
