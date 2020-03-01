package commentchecker_api;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import org.json.simple.JSONObject;

/**
 *
 * @author Essam
 */
public class run {

    @SuppressWarnings("unchecked")
    public static void main(String[] args) throws IOException {
        BufferedReader br = new BufferedReader(new FileReader(args[0])); // Creation of BufferedReader object
        float lines = 0;
        // while (br.readLine() != null) lines++;
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
        JSONObject result = new JSONObject();
        if (lines != 0) {
            float percent = (count / lines);
            result.put("commentsCount", count);
            result.put("linesCount", lines);
            result.put("percentage", percent);
        } else {
            result.put("commentsCount", 0);
            result.put("linesCount", 0);
            result.put("percentage", 0);
        }
        System.out.print(result);
    }
}
