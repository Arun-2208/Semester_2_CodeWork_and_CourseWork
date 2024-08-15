/**
 * The Student class is a very simple representation of a student which
 * contains attributes for the student first and last name and ID number
 * 
 * author : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
 * version : 1.0 - lab 4 -
 */

class Student{
  private String firstName;
  private String lastName;
  private String ID;

  /**
   * Constructor for objects of class Student
   *
   * @param   firstName student's first name
   * @param   lastName student's last name
   * @param   ID student's ID number
   */
  public Student(String firstName, String lastName, String ID)
  {
    this.firstName = firstName;
    this.lastName = lastName;
    this.ID = ID;
  }

  /**
   * Returns a string of login name
   *
   * @return    Returns a String object that contains a login name
   */
    public String getLoginName () {	 
   
		return (firstName.substring(0, 1) +  lastName);
	}
}

public class StudentCreator{

  public static void main(String[] args){

    Student s1 = new Student("Arun","Ragavendhar","104837257");
    Student s2 = new Student("Steve","Smith","58292826");

    System.out.println("Details of the 1st student : " + s1.getLoginName() +'\n');
    System.out.println("Details of the 2nd student : " + s2.getLoginName() +'\n');
  
  }
}