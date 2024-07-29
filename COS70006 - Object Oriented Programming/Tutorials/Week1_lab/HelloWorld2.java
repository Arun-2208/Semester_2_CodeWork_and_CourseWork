/**
 * Description
 * Author : Arun Ragavendhar Arunachalam Palaniyappan <104837257>
 * Lab : Week_1_lab
 */


 public class HelloWorld2{


    public static void main(String[] args){

        // we need to use an if - else block to handle a case where the user does not enter both the name and place on the command line 

        if(args.length<2){

            System.out.println("Please enter both your name and place to proceed !!");

        } else{

            System.out.println(" Welcome < " + args[0] + " > from " + args[1] +".");  

        }
    }
 }