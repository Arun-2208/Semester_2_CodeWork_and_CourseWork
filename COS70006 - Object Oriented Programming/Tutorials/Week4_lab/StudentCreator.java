

/**
 * This program creates at least two student objects with
 * different values and call getLoginName() to display login name for each student
 * @author : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
 * @version : 1.0 - lab 4 -
 */

public class StudentCreator{

  public static void main(String[] args){

// 2 objects have been created for the class Student 

    Student s1 = new Student("Arun","Ragavendhar","104837257");
    Student s2 = new Student("Steve","Smith","58292826");

// The output login names for both students is displayed to the user 

    System.out.println("Details of the 1st student : " + s1.getLoginName() +'\n');
    System.out.println("Details of the 2nd student : " + s2.getLoginName() +'\n');
  }
}