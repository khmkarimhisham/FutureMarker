package api;

public class FeatureTest {

    private String name;
    private String regex;
    private int Repetition;

    public FeatureTest(String name, String regex, int Repetition) {
        this.name = name;
        this.regex = regex;
        this.Repetition = Repetition;
    }

    /**
     * @return the name
     */
    public String getName() {
        return name;
    }

    /**
     * @return the regex
     */
    public String getRegex() {
        return regex;
    }

    /**
     * @return the Repetition
     */
    public int getRepetition() {
        return Repetition;
    }

}
