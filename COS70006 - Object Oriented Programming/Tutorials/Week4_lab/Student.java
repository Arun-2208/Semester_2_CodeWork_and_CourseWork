

class Student{
    private String firstName;
    private String lastName;
    private String ID;
  
  /*Constructor for objects of class Student*/
  
    public Student(String firstName, String lastName, String ID){
      this.firstName = firstName;
      this.lastName = lastName;
      this.ID = ID;
    }
  
  /* Returns a string of login name*/
  
    public String getLoginName (){	 
      return firstName.substring(0, 1) + lastName + " : " + ID;
      }
  }