package commentChecker;

import api.Assignment;
import api.DoingAssignment;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

/**
 *
 * @author Mohamed Essam
 */
public class CommentChecker {

    public static void check() {
        BufferedReader br;
        try {
            br = new BufferedReader(new FileReader(DoingAssignment.getAssignment_dir())); // Creation of BufferedReader object

            float lines = 0;
            String str;
            CharSequence word1 = "//";
            CharSequence word2 = "*/";
            // Input word to be searched
            float count = 0; // Intialize the word to zero
            while ((str = br.readLine()) != null) {// Reading Content from the file

                if (!str.isEmpty()) { // check if there is empty line
                    lines++;
                    if ((str.contains(word1)) || (str.contains(word2))) { // Search for the given word
                        count++; // If Present increase the count by one
                    }
                }
            }
            br.close();

            if (lines != 0) {
                float percent = count / lines;
                if (percent > 1) {
                    DoingAssignment.setComment_grade(1);
                    DoingAssignment.setComment_feedback("Your comments made the code clear");
                } else if (percent < 0.1) {
                    DoingAssignment.setComment_grade(percent);
                    DoingAssignment.setComment_feedback("You need to clarify your code by using more comments");
                } else {
                    DoingAssignment.setComment_grade(percent);
                    DoingAssignment.setComment_feedback("Your comments made the code clear");
                }
            } else {
                DoingAssignment.setComment_grade(0);
                DoingAssignment.setComment_feedback("You need to clarify your code by using more comments");
            }
        } catch (IOException e) {

        }
    }
}
