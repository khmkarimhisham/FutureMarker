package solii;

import java.util.Scanner;

public class area_of_pentagon {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Scanner input=new Scanner(System.in);
		System.out.print("please enter the lenght of the center ");
		//prompt the user to enter the lenght of the center
		double r=input.nextDouble();
		//compute the area of the pentagon
		double s= (2*r)*Math.sin(Math.PI/5);
		double area=(5*Math.pow(s, 2))/(4*Math.tan(Math.PI/5));
		//display result
		System.out.print("the ara of the pentagon is"+area);
		

	}

}