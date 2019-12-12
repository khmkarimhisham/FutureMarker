package Asimnt1;
import java.util.Scanner;
public class Tast1 {

	public static void main(String[] args) {
		Scanner input=new Scanner(System.in);
		double length, side,area;
		System.out.println("the length from the center of a pentagon");
		 length =input.nextDouble();
		 double redius=3.14;
	     side=2*length*Math.sin(5/redius);
	     area= (5*Math.pow(side,2))/4*Math.tan(5/redius);
	     System.out.println("the area of thepentagon"+area);
		

	}

}